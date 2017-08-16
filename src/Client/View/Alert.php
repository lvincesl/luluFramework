<?php
namespace Luluframework\Client\View;


class Alert
{
    const INFO      = 2;
    const SUCCESS   = 3;
    const WARNING   = 4;
    const DANGER    = 5;

    private $value;
    private $type;

    public function __construct($type = Alert::INFO)
    {
        $this->value = 0;
        $this->type = $type;
    }

    /**
     * Set Alert value
     *
     * @param string $value
     * @return boolean
     */
    public function set($value)
    {
        if (!is_string($value)) {
            return false;
        } else {
            $this->value = $value;
            return true;
        }
    }

    /**
     * Get Alert value
     *
     * @return void
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Set Alert type
     *
     * @param integer $type
     * @return boolean
     */
    public function setType($type)
    {
        if (!is_integer($type)) {
            return false;
        } elseif (  $type != Alert::INFO &&
                    $type != Alert::SUCCESS &&
                    $type != Alert::WARNING &&
                    $type != Alert::DANGER) {
            return false;
        } else {
            $this->type = $type;
            return true;
        }
    }

    /**
     * Get Alert type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the Alert html source code
     *
     * @return string
     */
    public function html()
    {
        switch ($this->type) {
            case Panel::INFO:
                    $class = "alert-info";
                    break;

            case Panel::SUCCESS:
                    $class = "alert-success";
                    break;

            case Panel::WARNING:
                    $class = "alert-warning";
                    break;

            case Panel::DANGER:
                    $class = "alert-danger";
                    break;
            
            default:
                $class = "alert-info";
                break;
        }

        return "<div class='alert $class'>{$this->value}</div>";
    }
}