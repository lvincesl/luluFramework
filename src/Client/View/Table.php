<?php
namespace Luluframework\Client\View;

use Luluframework\Client\View\Table\Row;

class Table
{
	protected $body;
	protected $header;
	protected $footer;
	protected $class;
	protected $headerClass;
	protected $bodyClass;
	protected $footerClass;
	protected $caption;
	protected $firstLineNumber;
	protected $checkbox;
	protected $collapsedIndex;
	protected $hasCheckbox;
	protected $hasOptions;

	/**
	 * Constructor
	 */
	public function __construct() 
	{
		$this->body 			= array();
		$this->header 			= array();
		$this->footer 			= array();
		$this->class 			= null;
		$this->headerClass 		= array();
		$this->bodyClass 		= null;
		$this->footerClass 		= array();
		$this->caption 			= null;
		$this->firstLineNumber 	= null;
		$this->collapsedIndex 	= null;
		$this->hasCheckbox 		= false;
		$this->hasOptions 		= false;
	}

	/**
	 * Add a new col
	 *
	 * @param string $colHeader
	 * @return boolean
	 */
	public function addCol($colHeader) 
	{
		if (!is_string($colHeader)) {
			return false;
		} else {
			array_push($this->header, $colHeader);
			foreach ($this->body as $row) {
				$row->addCell(null);
			}
			return true;
		}
	}

	/**
	 * Set table caption
	 *
	 * @param string $value
	 * @return boolean
	 */
	public function setCaption($value) 
	{
		if (!is_string($value)) {
			return false;
		} else {
			$this->caption = $value;
			return true;
		}
	}

	/**
	 * Get table caption
	 *
	 * @return string
	 */
	public function getCaption() 
	{
		return $this->caption;
	}

	/**
	 * Set table header
	 *
	 * @param array $header
	 * @return boolean
	 */
	public function setHeader($header) 
	{
		if (!is_array($header)) {
			return false;
		} else {
			$this->clear();
			foreach ($header as $key => $value) {
				array_push($this->header, $value);
			}
			return true;
		}
	}

	/**
	 * Get table header
	 *
	 * @return string
	 */
	public function getHeader()
	{
		return $this->header;
	}

	/**
	 * Set header class
	 *
	 * @param string $colHeader
	 * @param string $class
	 * @return boolean
	 */
	public function setHeaderClass($colHeader, $class) 
	{
		if (!is_string($colHeader)) {
			return false;
		} elseif (!is_string($class)) {
			return false;
		} else {
			$this->headerClass[$colHeader] = $class;
			return true;
		}
	}

	/**
	 * Get header class
	 *
	 * @return string
	 */
	public function getHeaderClass($colHeader)
	{
		if (!is_string($colHeader)) {
			return false;
		} else {
			return $this->headerClass[$colHeader];
		}
	}

	/**
	 * Add a row
	 *
	 * @param string $id
	 * @param array $values
	 * @return boolean
	 */
	public function addRow(Row $row)
	{
		array_push($this->body, $row);
		return true;
	}

	/**
	 * Clear table content
	 *
	 * @return boolean
	 */
	public function clear() 
	{
		$this->body 		= array();
		$this->header 		= array();
		$this->footer 		= array();
		$this->headerClass  = array();
		$this->bodyClass  	= array();
		$this->footerClass	= array();
		return true;
	}

	/**
	 * Activate rows checkbox
	 *
	 * @param boolean $boolean
	 * @return boolean
	 */
	public function hasCheckbox($boolean) 
	{
		if (!\is_bool($boolean)) {
			return false;
		} else {
			$this->hasCheckbox = $boolean;
			return true;
		}
	}

	/**
	 * Set table first line number
	 *
	 * @param integer $value
	 * @return boolean
	 */
	public function setFirstLineNumber($value) 
	{
		if (!is_integer($value)) {
			return false;
		} else {
			$this->firstLineNumber = $value;
			return true;
		}
	}

	/**
	 * Get table first line number
	 *
	 * @return integer
	 */
	public function getFirstLineNumber()
	{
		return $this->firstLineNumber;
	}

	/**
	 * Set collapsed index
	 *
	 * @param integer $index
	 * @return void
	 */
	public function setCollapsedIndex($index) 
	{
		if (!is_integer($index)) {
			return false;
		} else {
			$this->collapsedIndex = $index;
			return true;
		}
	}

	/**
	 * Get collapsed index
	 *
	 * @return integer
	 */
	public function getCollapsedIndex()
	{
		return $this->collapsedIndex;
	}

	public function hasOptions($boolean) 
	{
		if (!\is_bool($boolean)) {
			return false;
		} else {
			$this->hasOptions = $boolean;
			return true;
		}
	}

	/**
	 * Set table class
	 *
	 * @param string $class
	 * @return boolean
	 */
	public function setClass($class) 
	{
		if (!is_string($class)) {
			return false;
		} else {
			$this->class = $class;
			return true;
		}
	}

	/**
	 * Get table class
	 *
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * Return the table html source code
	 *
	 * @return string
	 */
	public function html() 
	{
		$H = 	"<thead data-uk-sticky=\"{top:-200, animation: 'uk-animation-slide-top'}\">".
					"<tr>".(is_null($this->collapsedIndex)?null:'<th></th>').
							($this->hasCheckbox?'<th><div class="checkbox"><input type=\'checkbox\'><label></label></div></th>':null).
							(is_null($this->firstLineNumber)?null:'<th data-toggle="true" class="uk-table-shrink">#</th>');
		
		foreach ($this->header as $key => $value) {
			if (isset($this->headerClass[$value])) {
				$H .= "<th class='".$this->headerClass[$value]."'><strong>$value</strong></th>";
			}
			else {
				$H .= "<th><strong>$value</strong></th>";				
			}
		}
		$H .= ($this->hasOptions?"<th class='uk-text-right'>Options</th>":null)."</tr></thead>";

		$i 				= 0;
		$collapse_id  	= 0; 
		$collapse_val 	= null;
		$highlight_val 	= null;
		foreach ($this->body as $key => $value) {
			$value->setLineNumber($this->firstLineNumber+(++$i));
			$value->hasCheckbox($this->hasCheckbox);
			$value->setCellsClass($this->headerClass);
			if (!is_null($this->collapsedIndex)) {
				if ($collapse_val != $value->getCell($this->collapsedIndex)) {
					$value->setCollapseId(++$collapse_id);
					$collapse_val = $value->getCell($this->collapsedIndex);
				}
				else {
					$value->addClass("collapse group$collapse_id");
				}
			}
		}

		$B = "<tbody>";
		foreach ($this->body as $key => $value) {
			$B .= $value->html();
		}
		$B .= "</tbody>";

		return (empty($this->body)?"<div class='text-center'><strong>Aucunes données disponibles</strong></div>":"<table class='table table-condensed table-striped table-hover uk-text-small'>".($this->caption?'<caption>'.$this->caption.'</caption>':null)."$H$B</table>");
		//return (empty($this->table_body)?"<div class='text-center'><strong>Aucunes données disponibles</strong></div>":"<table".(strlen($this->table_class)?' class="'.$this->table_class.'"':null).">".($this->caption?'<caption>'.$this->caption.'</caption>':null)."$header$body</table>");
	}
	
}