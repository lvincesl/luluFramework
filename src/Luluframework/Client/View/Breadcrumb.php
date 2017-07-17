<?php
namespace Luluframework\Client\View;


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
		$this->breadcrumb_array = array('Accueil' => vf_site::get_document_root());
	}

	/*
	* Ajoute un lien au fil d'ariane
	* @return void
	*/
	public function add_Item($text, $link=null) 
	{
		$this->breadcrumb_array[$text] = $link;
	}

	/**
	 * Return the html code
	 *
	 * @return void
	 */
	public function get_Html() 
	{
		$breadcrumb_html = '<ol class="breadcrumb">';
		$this->breadcrumb_array["Accueil"] = vf_site::get_document_root();
		$i=0;
		foreach ($this->breadcrumb_array as $text => $link) {
			$breadcrumb_html .= "<li class='breadcrumb-item ".(is_null($link)?'active':null)."'>".($i==0?"Vous êtes ici : ":null).(is_null($link)?"<span href=\"#\">$text</span>":"<a href=\"$link\">$text</a>")."</li>";
			$i++;
		}

		return $breadcrumb_html.'</ol>';
	}
}