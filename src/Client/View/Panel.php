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
    private $class;
    private $headerClass;
    private $bodyClass;
    private $footerClass;
    private $refreshWidgetVisible;

    public function __construct()
    {
        $this->header       = null;
        $this->body         = null;
        $this->footer       = null;
        $this->type         = Panel::DEFAULT;
        $this->class        = null;
        $this->headerClass  = null;
        $this->bodyClass    = null;
        $this->footerClass  = null;
        $this->refreshWidgetVisible = false;
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
     * Set panel class
     *
     * @param string $class
     * @return boolean
     */
    public function setClass($class)
    {
        if (!is_string($class)) {
            return false;
        } else {
            $this->class = $class;
            return true;
        }
    }

    /**
     * Get panel class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set panel header class
     *
     * @param string $headerClass
     * @return boolean
     */
    public function setHeaderClass($headerClass)
    {
        if (!is_string($headerClass)) {
            return false;
        } else {
            $this->headerClass = $headerClass;
            return true;
        }
    }

    /**
     * Get panel header class
     *
     * @return string
     */
    public function getHeaderClass()
    {
        return $this->headerClass;
    }
    
    /**
     * Set panel body class
     *
     * @param string $bodyClass
     * @return boolean
     */
    public function setBodyClass($bodyClass)
    {
        if (!is_string($bodyClass)) {
            return false;
        } else {
            $this->bodyClass = $bodyClass;
            return true;
        }
    }

    /**
     * Get panel body class
     *
     * @return string
     */
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

    /**
     * Set panel footer class
     *
     * @param string $footerClass
     * @return boolean
     */
    public function setFooterClass($footerClass)
    {
        if (!is_string($footerClass)) {
            return false;
        } else {
            $this->footerClass = $footerClass;
            return true;
        }
    }

    /**
     * Get ppanel footer class
     *
     * @return string
     */
    public function getFooterClass()
    {
        return $this->footerClass;
    }

    /**
     * Set the refresh widget visible or not
     *
     * @param boolean $boolean
     * @return boolean
     */
    public function setRefreshWidgetVisible($boolean)
    {
        if (!is_bool($boolean)) {
            return false;
        } else {
            $this->refreshWidgetVisible = $boolean;
            return true;
        }
    }

    /**
     * Get RefreshWidgetVisible value
     *
     * @return boolean
     */
    public function getRefreshWidgetVisible()
    {
        return $this->refreshWidgetVisible;
    }
    
    /**
     * Return the panel html source code
     *
     * @return string
     */
    public function html()
    {
        $typeClass = null;
        $refreshWidget = null;

        if ($this->refreshWidgetVisible) {
            $refreshWidget = "<a id='panel-refresh-widget' class='pull-right' href='#' data-toggle='tooltip' title='Refresh'><span class='fa fa-refresh'></span></a>";
        } else {
            $refreshWidget = null;
        }

        switch ($this->type) {
            case Panel::DEFAULT:
                $typeClass = "panel-default";
                break;

            case Panel::PRIMARY:
                $typeClass = "panel-primary";
                break;

            case Panel::INFO:
                $typeClass = "panel-info";
                break;

            case Panel::SUCCESS:
                $typeClass = "panel-success";
                break;

            case Panel::WARNING:
                $typeClass = "panel-warning";
                break;

            case Panel::DANGER:
                $typeClass = "panel-danger";
                break;
            
            default:
                $typeClass = "panel-default";
                break;
        }

        return "\n
                <div class='panel $typeClass {$this->class}'>\n
                    <div class='panel-heading {$this->headerClass}'>$refreshWidget{$this->header}</div>\n
                    <div class='panel-body {$this->bodyClass}'>{$this->body}</div>\n
                    <div class='panel-footer {$this->footerClass}'>{$this->footer}</div>\n
                </div>\n";
    }
}