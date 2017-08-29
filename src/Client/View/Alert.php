<?php
namespace Luluframework\Client\View;


class Alert
{
    const PRIMARY   = 1;
    const INFO      = 2;
    const SUCCESS   = 3;
    const WARNING   = 4;
    const DANGER    = 5;
    const SECONDARY = 6;
    const LIGHT     = 6;
    const DARK      = 6;

    private $id;
    private $value;
    private $type;
    private $dismiss;

    public function __construct($type = Alert::INFO)
    {
        $this->id       = null;
        $this->value    = 0;
        $this->type     = $type;
        $this->dismiss  = false;
    }

    /**
     * Set Alert id
     *
     * @param string $id
     * @return boolean
     */
    public function setId($id) {
        if (!is_string($id)) {
            return false;
        } else {
            $this->id = $id;
            return true;
        }
    }

    /**
     * Ged Alert id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
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
     * Dismiss alert
     *
     * @param boolean $boolean
     * @return boolean
     */
    public function dismiss($boolean)
    {
        if (!is_bool($boolean)) {
            return false;
        } else {
            $this->dismiss = $boolean;
            return true;
        }
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

        if ($this->dismiss) {
            $dismiss_code = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        } else {
            $dismiss_code = null;
        }

        return "<div ".($this->id?"id='{$this->id}' ":null)."class='alert $class".($this->dismiss?' alert-dismissable':null)."'>$dismiss_code{$this->value}</div>";
    }
}