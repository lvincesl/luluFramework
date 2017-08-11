<?php

namespace Luluframework\Client\View;

class Panel
{
    const DEFAULT   = 0;
    const PRIMARY   = 1;
    const INFO      = 2;
    const SUCCESS   = 3;
    const WARNING   = 4;
    const DANGER    = 5;

    private $header;
    private $body;
    private $footer;
    private $type;

    public function __construct()
    {
        $this->header   = null;
        $this->body     = null;
        $this->footer   = null;
        $this->type     = Panel::DEFAULT;
    }

    /**
     * Set panel header
     *
     * @param string $header
     * @return boolean
     */
    public function setHeader($header)
    {
        if (!is_string($header)) {
            return false;
        } else {
            $this->header = $header;
            return true;
        }
    }

    /**
     * Get panel header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set panel body
     *
     * @param string $body
     * @return boolean
     */
    public function setBody($body)
    {
        if (!is_string($body)) {
            return false;
        } else {
            $this->body = $body;
            return true;
        }
    }

    /**
     * Get panel body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set panel footer
     *
     * @param string $footer
     * @return boolean
     */
    public function setFooter($footer)
    {
        if (!is_string($footer)) {
            return false;
        } else {
            $this->footer = $footer;
            return true;
        }
    }

    /**
     * Get ppanel footer
     *
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set panel type
     *
     * @param integer $type
     * @return boolean
     */
    public function setType($type)
    {
        if (!is_integer($type)) {
            return false;
        } elseif (  $type != Panel::DEFAULT &&
                    $type != Panel::INFO &&
                    $type != Panel::PRIMARY &&
                    $type != Panel::SUCCESS &&
                    $type != Panel::WARNING &&
                    $type != Panel::DANGER) {
            return false;
        } else {
            $this->type = $type;
            return true;
        }
    }

    /**
     * Get panel type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the panem html source code
     *
     * @return string
     */
    public function html()
    {
        switch ($this->type) {
            case Panel::DEFAULT:
                $class = "panel-default";
                break;

            case Panel::PRIMARY:
                    $class = "panel-primary";
                    break;

            case Panel::INFO:
                    $class = "panel-info";
                    break;

            case Panel::SUCCESS:
                    $class = "panel-success";
                    break;

            case Panel::WARNING:
                    $class = "panel-warning";
                    break;

            case Panel::DANGER:
                    $class = "panel-danger";
                    break;
            
            default:
                $class = "panel-default";
                break;
        }

        return "<div class='panel $class'>
                    <div class='panel-heading'>{$this->header}</div>
                    <div class='panel-body'>{$this->body}</div>
                    <div class='panel-footer'>{$this->footer}</div>
                </div>";
    }
}