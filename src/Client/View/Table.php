<?php
namespace Luluframework\Client\View;

use Luluframework\Client\View\Table\Row;

class Table
{
	protected $table_body;
	protected $table_header;

	protected $table_class;
	protected $header_class;
	protected $body_class;

	protected $caption;
	protected $first_line_number;
	protected $checkbox;
	protected $edit_link;
	protected $copy_link;
	protected $delete_link;
	protected $apply_link;
	protected $print_link;
	protected $info_link;
	protected $collapse;
	protected $options_enabled;

	public function __construct() 
	{
		$this->table_body = array();
		$this->table_header = array();
		$this->caption = null;
		$this->first_line_number = null;
		$this->buttons = array();
		$this->checkbox = false;
		$this->edit_link = null;
		$this->copy_link = null;
		$this->delete_link = null;
		$this->apply_link = null;
		$this->print_link = null;
		$this->info_link = null;
		$this->collapse = null;
		$this->header_class = null;
		$this->options_enabled = false;
	}

	public function add_column($column_name) 
	{
		array_push($this->table_head, $column_name);
		foreach ($this->table_body as $key => $value) {
			$value->add_cell($column_name);
		}
	}

	public function set_caption($value) 
	{
		$this->caption = $value;
	}

	public function get_caption() 
	{
		return $this->caption;
	}

	public function set_header($header) 
	{
		if (is_array($header)) {
			$this->clear();
			foreach ($header as $key => $value) {
				array_push($this->table_header, $value);
			}
			return true;
		}
		else return false;
	}

	public function set_header_class($header_name, $class_name) 
	{
		$this->header_class[$header_name] = $class_name;
	}

	public function add_row($id = null, $values = null, $edit_permission=false, $copy_permission=false, $delete_permission=false, $apply_permission=false, $print_permission=false)
	{
		if (!is_null($values)) {
			$row = new Row($id, sizeof($this->table_header));
			$row->set_cells($values);
			//$row->set_view_permission($view_permission);
			$row->set_edit_permission($edit_permission);
			$row->set_copy_permission($copy_permission);
			$row->set_delete_permission($delete_permission);
			$row->set_apply_permission($apply_permission);
			$row->set_print_permission($print_permission);
			$row->set_edit_link($this->edit_link);
			$row->set_copy_link($this->copy_link);
			$row->set_delete_link($this->delete_link);
			$row->set_apply_link($this->apply_link);
			$row->set_print_link($this->print_link);
			array_push($this->table_body, $row);
		}
		else array_push($this->table_body, new vf_table_row($id, sizeof($this->table_header)));
	}

	public function clear() 
	{
		$this->table_body = array();
		$this->table_header = array();
	}

	public function set_checkbox($value=false) 
	{
		$this->checkbox = $value;
	}

	public function set_first_line_number($line_number) 
	{
		$this->first_line_number = $line_number;
	}

	public function set_edit_link($link) 
	{
		$this->edit_link = $link;
	}

	public function set_copy_link($link) 
	{
		$this->copy_link = $link;
	}

	public function set_delete_link($link) 
	{
		$this->delete_link = $link;
	}

	public function set_apply_link($link) 
	{
		$this->apply_link = $link;
	}
	
	public function set_print_link($link) 
	{
		$this->print_link = $link;
	}

	public function collapse($collumn_index) 
	{
		$this->collapse = $collumn_index;
	}

	public function options_enabled($bool) 
	{
		$this->options_enabled = $bool;
	}

	public function set_table_class($class) 
	{
		$this->table_class = $class;
	}

	/**
	 * Return the table source code
	 *
	 * @return string
	 */
	public function getSourceCode() 
	{
		$header = "<thead data-uk-sticky=\"{top:-200, animation: 'uk-animation-slide-top'}\"><tr>".($this->collapse?'<th></th>':null).
								($this->checkbox?'<th><div class="checkbox"><input type=\'checkbox\'><label></label></div></th>':null).
								(is_null($this->first_line_number)?null:'<th data-toggle="true" class="uk-table-shrink">#</th>');
		
		foreach ($this->table_header as $key => $value) {
			if (isset($this->header_class[$value])) {
				$header .= "<th class='".$this->header_class[$value]."'><strong>$value</strong></th>";
			}
			else {
				$header .= "<th><strong>$value</strong></th>";				
			}
		}
		$header .= ($this->options_enabled?"<th class='uk-text-right'>Options</th>":null)."</tr></thead>";

		$i 				= 0;
		$collapse_id  	= 0; 
		$collapse_val 	= null;
		$highlight_val 	= null;
		foreach ($this->table_body as $key => $value) {
			$value->set_line_number($this->first_line_number+(++$i));
			$value->set_checkbox($this->checkbox);
			$value->set_cells_class($this->header_class);
			if ($this->collapse) {
				if ($collapse_val != $value->get_col($this->collapse)) {
					$value->set_collapse_id(++$collapse_id);
					$collapse_val = $value->get_col($this->collapse);
				}
				else {
					$value->add_class("collapse group$collapse_id");
				}
			}
		}

		$body = "<tbody>";
		foreach ($this->table_body as $key => $value) {
			$body .= $value->get_html();
		}
		$body .= "</tbody>";

		return (empty($this->table_body)?"<div class='text-center'><strong>Aucunes données disponibles</strong></div>":"<table class='table table-condensed table-striped table-hover uk-text-small'>".($this->caption?'<caption>'.$this->caption.'</caption>':null)."$header$body</table>");
		//return (empty($this->table_body)?"<div class='text-center'><strong>Aucunes données disponibles</strong></div>":"<table".(strlen($this->table_class)?' class="'.$this->table_class.'"':null).">".($this->caption?'<caption>'.$this->caption.'</caption>':null)."$header$body</table>");
	}
	
}