<?php
namespace Luluframework\Client\View;

use \Luluframework\Application;

class Breadcrumb 
{
	protected $breadcrumb_array;

	/**
	 * Create a new Breadcrumb instance
	 *
	 * @param string $document_root
	 */
	public function __construct()
	{
		$this->breadcrumb_array = array('Accueil' => Application::get_document_root());
	}

	/**
	 * Set breadcrumb items
	 *
	 * @param array $array
	 * @return boolean
	 */
	public function set($array)
	{
		if (!is_array($array)) {
			return false;
		} elseif (!\is_string(array_keys($array)[0])) {
			return false;
		} else {
			$this->breadcrumb_array = $array;
			return true;
		}
	}

	/**
	 * Get breadcrumb items
	 *
	 * @return array
	 */
	public function get()
	{
		return $this->breadcrumb_array;
	}

	/**
	 * Add an item to the breadcrumb
	 *
	 * @param string $text
	 * @param string $link
	 * @return boolean
	 */
	public function add($text, $link=null) 
	{
		if (!\is_string($text)) {
			return false;
		} elseif (!is_null($link) && !is_string($link)) {
			return false;
		} else {
			$this->breadcrumb_array[$text] = $link;
			return true;
		}
	}

	/**
	 * Return the breadcrumb html source code
	 *
	 * @return string
	 */
	public function html() 
	{
		$breadcrumb_html = '<ol class="breadcrumb">';
		$this->breadcrumb_array["Accueil"] = Application::get_document_root();
		$i=0;
		foreach ($this->breadcrumb_array as $text => $link) {
			$breadcrumb_html .= "<li class='breadcrumb-item ".(is_null($link)?'active':null)."'>".($i==0?"Vous êtes ici : ":null).(is_null($link)?"<span href=\"#\">$text</span>":"<a href=\"$link\">$text</a>")."</li>";
			$i++;
		}

		return $breadcrumb_html.'</ol>';
	}
}