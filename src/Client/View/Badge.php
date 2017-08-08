<?php
namespace Luluframework\Client\View;


class Badge
{
    private $value;

    public function __construct()
    {
        $this->value = 0;
    }

    /**
     * Set Badge value
     *
     * @param integer $value
     * @return boolean
     */
    public function set($value)
    {
        if (!is_integer($value)) {
            return false;
        } else {
            $this->value = $value;
            return true;
        }
    }

    /**
     * Get Badge value
     *
     * @return void
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Return the Badge html source code
     *
     * @return string
     */
    public function html()
    {
        return "<span class='badge'>{$this->value}</span>";
    }
}