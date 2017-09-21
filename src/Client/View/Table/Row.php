<?php

namespace Luluframework\Client\View\Table;

use \Luluframework\Client\View\Table\Row\Option;

class Row {

	private $id;
	private $cells;
	private $options;
	private $collapseId;
	private $lineNumber;
	private $class;
	private $cellsClass;
	private $cellsColspan;
	private $cellsRowspan;
	private $hasCheckbox;


	/**
	 * Constructor
	 *
	 * @param string $id
	 */
	public function __construct($id)
	{
		if (!is_string($id)) {
            throw new \Exception("InvalidArgumentException : string expected for 'id' !");
        } else {
			$this->id 			= $id;
			$this->cells 		= array();
			$this->options 		= array();
			$this->collapseId 	= null;
			$this->lineNumber 	= null;
			$this->class 		= null;
			$this->cellsClass   = null;
			$this->cellsColspan = null;
			$this->cellsRowspan = null;
			$this->hasCheckbox 	= false;
		}
	}

	/**
	 * Add a cell to the table row
	 *
	 * @param string $value
	 * @return boolean
	 */
	public function addCell($value) 
	{
		if (!\is_string($value) && !is_null($value)) {
			return false;
		} else {
			array_push($this->cells, $value);
			return true;
		}
	}

	/**
	 * Delete a cell
	 *
	 * @param integer $index
	 * @return boolean
	 */
	public function delCell($index)
	{
		if (!is_integer($index)) {
			return false;
		} elseif ($index >= count($this->cells)) {
			return false;
		} else {
			unset($this->cells[$index]);
			return true;
		}
	}

	/**
	 * Get cell value
	 *
	 * @param integer $index
	 * @return string
	 */
	public function getCell($index)
	{
		if (!is_integer($index)) {
			return false;
		} elseif ($index >= count($this->cells)) {
			return false;
		} else {
			return $this->cells[$index];
		}
	}

	/**
	 * Set cells values
	 *
	 * @param array $values
	 * @return boolean
	 */
	public function setCells($values)
	{
		if (!is_array($values)) {
			return false;
		} else {
			$this->cells = $values;
			return true;
		}
	}

	/**
	 * Get cells
	 *
	 * @return array
	 */
	public function getCells()
	{
		return $this->cells;
	}

	/**
	 * Set the row Id
	 *
	 * @param mixed $id
	 * @return boolean
	 */
	public function setId($id)
	{
		if (!is_string($id) && !is_numeric($id)) {
			return false;
		} else {
			$this->id = $id;
			return true;
		}
	}

	/**
	 * Get row Id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Add an option
	 *
	 * @param Option $option
	 * @return boolean
	 */
	public function addOption(Option $option)
	{
		array_push($this->options, $option);
		return true;
	}

	/**
	 * Set row line number
	 *
	 * @param integer $value
	 * @return boolean
	 */
	public function setLineNumber($value)
	{
		if (!is_integer($value)) {
			return false;
		} else {
			$this->lineNumber = $value;
			return true;
		}
	}

	/**
	 * Get row line number
	 *
	 * @return integer
	 */
	public function getLineNumber()
	{
		return $this->lineNumber;
	}

	/**
	 * Activate row checkbox
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
	 * Set option class
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
	 * Get row class
	 *
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * Set cells class
	 *
	 * @param string $class
	 * @return boolean
	 */
	public function setCellsClass($class)
	{
		if (!is_array($class)) {
			return false;
		} else {
			$this->cellsClass = $class;
			return true;
		}
	}

	/**
	 * Get cells class
	 *
	 * @return string
	 */
	public function getCellsClass()
	{
		return $this->cellsClass;
	}

	/**
	 * Set cells colspan
	 *
	 * @param array $colspan
	 * @return boolean
	 */
	public function setCellsColspan($colspan)
	{
		if (!is_array($colspan)) {
			return false;
		} else {
			$this->cellsColspan = $colspan;
			return true;
		}
	}

	/**
	 * Get cells colspan
	 *
	 * @return void
	 */
	public function getCellsColspan()
	{
		return $this->cellsColspan;
	}

	/**
	 * Set cells rowspan
	 *
	 * @param string $rowspan
	 * @return boolean
	 */
	public function setCellsRowspan($rowspan)
	{
		if (!is_array($rowspan)) {
			return false;
		} else {
			$this->cellsRowspan = $rowspan;
			return true;
		}
	}

	/**
	 * Get cells rowspan
	 *
	 * @return void
	 */
	public function getCellsRowspan()
	{
		return $this->cellsRowspan;
	}

	/**
	 * Set collapse id
	 *
	 * @param string $id
	 * @return boolean
	 */
	public function setCollapseId($id)
	{
		if (!is_string($id)) {
			return false;
		} else {
			$this->collapseId = $id;
			return true;
		}
	}

	/**
	 * Get collapse id
	 *
	 * @return string
	 */
	public function getCollapseId()
	{
		return $this->collapseId;
	}

	/**
	 * Return row html source code
	 *
	 * @return string
	 */
	public function html() 
	{
		$r = "<tr id='row-{$this->id}' ".($this->collapseId?"data-toggle='collapse' data-target='.group{$this->collapseId}'":null).
							($this->class?" class='{$this->class}'":null).">".
							($this->collapseId?"<td><i class='fa fa-plus-square' aria-hidden='true'></i></td>":null).
							(strstr($this->class, 'collapse')!==FALSE?"<td></td>":null).
							($this->hasCheckbox?"<td><div class='checkbox'><input type='checkbox' id='checkbox_{$this->id}' name='checkbox_{$this->id}'><label></label></div></td>":null).
							(is_null($this->lineNumber)?null:"<th scope='row'>{$this->lineNumber}</th>");
		
		foreach ($this->cells as $key => $value) {
			$r .= "<td ".(isset($this->cellsClass[$key])?"class='{$this->cellsClass[$key]}'":null).(isset($this->cellsColspan[$key])?" colspan='{$this->cellsColspan[$key]}'":null).(isset($this->cellsRowspan[$key])?" rowspan='{$this->cellsRowspan[$key]}'":null).">$value</td>";
		}

		/* Inserting options */
		$r .= "<td class='uk-text-right uk-text-nowrap'>";
		foreach ($this->options as $option) {
			$r .= $option->html();
		}

		return "$r</tr>";
	}

	/**
	 * Delete all cells
	 *
	 * @return boolean
	 */
	public function clear() 
	{
		$this->cells = array();
		$this->cellsClass = array();
		$this->options = array();
		return true;
	}
}