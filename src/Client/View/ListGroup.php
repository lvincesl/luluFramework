<?php

namespace Luluframework\Client\View;


class ListGroup
{
    private $items;

    public function __construct()
    {
        $this->items = array();
    }

    /**
     * Add item to listgroup
     *
     * @param string $item
     * @param string $class
     * @return void
     */
    public function add($item, $class=null)
    {
        array_push($this->items, array("item" => $item, "class" => $class));
        return true;
    }

    /**
     * Return listgroup items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set listgroup items
     *
     * @param string $items
     * @return boolean
     */
    public function setItems($array)
    {
        $this->items = $array;
        return true;
    }

    /**
     * Return the listgroup HTML source code
     *
     * @return string
     */
    public function getHtml()
    {
        $source = "";
        return $source;
    }
}