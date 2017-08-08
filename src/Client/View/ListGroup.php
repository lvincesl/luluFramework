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
     * Get listgroup items
     *
     * @return array
     */
    public function get()
    {
        return $this->items;
    }

    /**
     * Set listgroup items
     *
     * @param array $array
     * @return boolean
     */
    public function set($array)
    {
        if (!is_array($array)) {
            return false;
        } else {
            $this->items = $array;
            return true;
        }
    }

    /**
     * Add item to listgroup
     *
     * @param string $item
     * @param string $class
     * @return boolean
     */
    public function add($item, $class=null)
    {
        if (!\is_string($item)) {
            return false;
        } elseif (!is_null($class) && !is_string($class)) {
            return false;
        } else {
            array_push($this->items, array("item" => $item, "class" => $class));
            return true;
        }
    }

    /**
     * Return the listgroup HTML source code
     *
     * @return string
     */
    public function html()
    {
        $source = "<ul class='list-group'>";
        foreach ($this->items as $item) {
            $source .= "<li class='list-group-item {$item['class']}'>{$item['item']}</li>";
        }
        return "$source</ul>";
    }
}