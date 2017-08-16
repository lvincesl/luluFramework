<?php
namespace Luluframework\Client\View;


class Label
{
    const DEFAULT   = 0;
    const PRIMARY   = 1;
    const INFO      = 2;
    const SUCCESS   = 3;
    const WARNING   = 4;
    const DANGER    = 5;

    private $value;
    private $type;

    public function __construct($type = Label::DEFAULT)
    {
        $this->value = 0;
        $this->type = $type;
    }

    /**
     * Set Label value
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
     * Get Label value
     *
     * @return void
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Set Label type
     *
     * @param integer $type
     * @return boolean
     */
    public function setType($type)
    {
        if (!is_integer($type)) {
            return false;
        } elseif (  $type != Label::DEFAULT &&
                    $type != Label::INFO &&
                    $type != Label::PRIMARY &&
                    $type != Label::SUCCESS &&
                    $type != Label::WARNING &&
                    $type != Label::DANGER) {
            return false;
        } else {
            $this->type = $type;
            return true;
        }
    }

    /**
     * Get Label type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the Label html source code
     *
     * @return string
     */
    public function html()
    {
        switch ($this->type) {
            case Panel::DEFAULT:
                $class = "label-default";
                break;

            case Panel::PRIMARY:
                    $class = "label-primary";
                    break;

            case Panel::INFO:
                    $class = "label-info";
                    break;

            case Panel::SUCCESS:
                    $class = "label-success";
                    break;

            case Panel::WARNING:
                    $class = "label-warning";
                    break;

            case Panel::DANGER:
                    $class = "label-danger";
                    break;
            
            default:
                $class = "label-default";
                break;
        }

        return "<span class='label $class'>{$this->value}</span>";
    }
}