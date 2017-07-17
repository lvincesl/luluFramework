<?php
namespace Luluframework\Client\View\Table;

class Row {
	protected $row;
	protected $id;
	protected $line_number;
	protected $view_permission;
	protected $edit_permission;
	protected $copy_permission;
	protected $delete_permission;
	protected $apply_permission;
	protected $print_permission;
	protected $view_link;
	protected $edit_link;
	protected $copy_link;
	protected $delete_link;
	protected $apply_link;
	protected $print_link;
	protected $checkbox;
	protected $collapse_id;
	protected $class_names;
	protected $cells_class;

	
	public function __construct($id, $cols) {
		$this->row = array();
		array_fill($this->row, $cols, null);
		$this->id = $id;
		$this->line_number = null;
		$this->view_permission = false;
		$this->edit_permission = false;
		$this->copy_permission = false;
		$this->delete_permission = false;
		$this->apply_permission = false;
		$this->print_permission = false;
		$this->view_link = null;
		$this->edit_link = null;
		$this->copy_link = null;
		$this->delete_link = null;
		$this->apply_link = null;
		$this->print_link = null;
		$this->checkbox = false;
		$this->collapse_id = null;
		$this->class_names = null;
		$this->cells_class = null;
	}

	public function add_col($cell_value) {
		array_push($this->row, $cell_value);
	}

	public function set_view_link($link) {
		$this->view_link = $link;
	}

	public function set_edit_link($link) {
		$this->edit_link = $link;
	}

	public function set_copy_link($link) {
		$this->copy_link = $link;
	}

	public function set_delete_link($link) {
		$this->delete_link = $link;
	}

	public function set_apply_link($link) {
		$this->apply_link = $link;
	}
	
	public function set_print_link($link) {
		$this->print_link = $link;
	}

	public function set_cells($values) {
		$this->row = $values;
	}

	public function set_id($id) {
		$this->id = $id;
	}

	public function set_line_number($value) {
		$this->line_number = $value;
	}

	public function set_view_permission($permission) {
		$this->view_permission = $permission;
	}

	public function set_edit_permission($permission) {
		$this->edit_permission = $permission;
	}

	public function set_copy_permission($permission) {
		$this->copy_permission = $permission;
	}

	public function set_delete_permission($permission) {
		$this->delete_permission = $permission;
	}

	public function set_apply_permission($permission) {
		$this->apply_permission = $permission;
	}

	public function set_print_permission($permission) {
		$this->print_permission = $permission;
	}

	public function set_checkbox($value) {
		$this->checkbox = $value;
	}

	public function add_class($class_name) {
		$this->class_names .= "$class_name ";
	}

	public function get_col($collum_index) {
		return $this->row[$collum_index];
	}

	public function set_cells_class($array) {
		$this->cells_class = $array;
	}

	public function get_html() {
		$r = "<tr id='row-".$this->id."' ".($this->collapse_id?"data-toggle='collapse' data-target='.group".$this->collapse_id."'":null).
							($this->class_names?" class='".$this->class_names."'":null).">".
							($this->collapse_id?"<td><i class='fa fa-plus-square' aria-hidden='true'></i></td>":null).
							(strstr($this->class_names, 'collapse')!==FALSE?"<td></td>":null).
							($this->checkbox?'<td><div class=\'checkbox\'><input type=\'checkbox\' id=\'checkbox_'.$this->id.'\' name=\'checkbox_'.$this->id.'\'><label></label></div></td>':null).
							(is_null($this->line_number)?null:'<th scope="row">'.$this->line_number.'</th>');
		
		foreach ($this->row as $key => $value) {
			$r .= "<td ".(isset($this->cells_class[$key])?"class='".$this->cells_class[$key]."'":null).">$value</td>";
		}

		/* Inserting controls */
		$r .= "<td class='uk-text-right uk-text-nowrap'>";
		//$r .= ($this->view_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Afficher' class='uk-button uk-button-small' role='button' onclick='$.redirect(\"".$this->view_link."\",{ edit: ".$this->id."});'><i class='fa fa-info-circle' aria-hidden='true'></i></a>":null);
		$r .= ($this->edit_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Modifier' class='uk-button uk-button-small' role='button' onclick='$.redirect(\"".$this->edit_link."\",{ edit: ".$this->id."});'><i class='fa fa-pencil' aria-hidden='true'></i></a>":null);
		$r .= ($this->copy_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Dupliquer' class='uk-button uk-button-small' role='button' onclick='$.redirect(\"".$this->copy_link."\",{ copy: ".$this->id."});'><i class='fa fa-clone' aria-hidden='true'></i></a>":null);
		$r .= ($this->delete_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Supprimer' class='uk-button uk-button-danger uk-button-small' role='button' onclick='$.redirect(\"".$this->delete_link."\",{ delete: ".$this->id."});'><i class='fa fa-trash' aria-hidden='true'></i></a>":null);
		$r .= ($this->apply_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Traiter' class='uk-button uk-button-primary uk-button-small' role='button' onclick='$.redirect(\"".$this->apply_link."\",{ apply: ".$this->id."});'><i class='fa fa-check' aria-hidden='true'></i></a>":null);
		$r .= ($this->print_permission?"&nbsp;<a href='#'  data-toggle='tooltip' title='Imprimer' class='uk-button uk-button-small' role='button' onclick='$.redirect(\"".$this->print_link."\",{ print: ".$this->id."});'><i class='fa fa-print' aria-hidden='true'></i></a>":null);
		$r .= "</td>";
		return $r.'</tr>';
	}

	public function clear() {
		$this->row = array();
	}

	public function delete_cell($cell_pos) {
		unset($this->row[$cell_pos]);
	}

	public function set_collapse_id($collapse_id) {
		$this->collapse_id = $collapse_id;
	}

	public function highlight($boolean) {
		$this->highlight = $boolean;
	}

}

?>