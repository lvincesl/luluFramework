<?php

namespace Luluframework\Client\View;


class ListGroup
{
    const BASIC_LISTGROUP = 0;
    const HYPERLINK_LISTGROUP = 1;
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
     * @param string $link
     * @param string $class
     * @return boolean
     */
    public function add($item, $link=null, $class=null)
    {
        if (!\is_string($item)) {
            return false;
        } elseif (!is_null($link) && !is_string($link)) {
            return false;
        } elseif (!is_null($class) && !is_string($class)) {
            return false;
        } else {
            array_push($this->items, array("item" => $item, "link" => $link, "class" => $class));
            return true;
        }
    }

    /**
     * Return the listgroup HTML source code
     *
     * @return string
     */
    public function html($type=self::BASIC_LISTGROUP)
    {
        if (!is_integer($type)) {
            return false;
        } elseif ($type != self::BASIC_LISTGROUP && $type != self::HYPERLINK_LISTGROUP) {
            return false;
        } else {
            $source = ($type==self::HYPERLINK_LISTGROUP?"<div class='list-group'>":"<ul class='list-group'>");
            foreach ($this->items as $item) {
                if ($type==self::HYPERLINK_LISTGROUP) {
                    $source .= "<a href='{$item['link']}' class='list-group-item {$item['class']}'>{$item['item']}</a>";
                } else {
                    $source .= "<li class='list-group-item {$item['class']}'>{$item['item']}</li>";
                }
            }
            return $source.($type==self::HYPERLINK_LISTGROUP?'</div>':'</ul>');
        }
    }
}