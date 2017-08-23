<?php

namespace Luluframework\Client\View;

class Button
{
    const DEFAULT   = 0;
    const PRIMARY   = 1;
    const SUCCESS   = 2;
    const INFO      = 3;
    const WARNING   = 4;
    const DANGER    = 5;
    const LINK      = 6;

    private $text;
    private $tooltip;
    private $class;
    private $type;
    private $modalId;
    private $onclick;
    private $id;

    public function __construct($text=null)
    {
        if (!is_string($text) && !is_null($text)) {
            throw new \Exception("InvalidArgumentException : string expected for 'text' !");
        } else {
            $this->text     = $text;
            $this->tooltip  = null;
            $this->class    = null;
            $this->type     = Button::DEFAULT;
            $this->modalId  = null;
            $this->onclick  = null;
            $this->id       = null;
        }
    }

    /**
     * Set button text
     *
     * @param string $id
     * @return boolean
     */
    public function setText($text)
    {
        if (!is_string($text))
        {
            return false;
        } else {
            $this->text = $text;
            return true;
        }
    }

    /**
     * Get button text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set button tooltip
     *
     * @param string $id
     * @return boolean
     */
    public function setTooltip($tooltip)
    {
        if (!is_string($tooltip))
        {
            return false;
        } else {
            $this->tooltip = $tooltip;
            return true;
        }
    }

    /**
     * Get button tooltip
     *
     * @return string
     */
    public function getTooltip()
    {
        return $this->tooltip;
    }

    /**
	 * Set button class
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
	 * Get button class
	 *
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
    }
    
    /**
     * Set button type
     *
     * @param integer $type
     * @return boolean
     */
    public function setType($type)
    {
        if (!is_integer($type)) {
            return false;
        } elseif (  $type != Button::DEFAULT &&
                    $type != Button::INFO &&
                    $type != Button::PRIMARY &&
                    $type != Button::SUCCESS &&
                    $type != Button::WARNING &&
                    $type != Button::DANGER &&
                    $type != Button::LINK) {
            return false;
        } else {
            $this->type = $type;
            return true;
        }
    }

    /**
     * Get button type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
	 * Set modal id
	 *
	 * @param string $modalId
	 * @return boolean
	 */
	public function setModalId($modalId) 
	{
		if (!is_string($modalId)) {
			return false;
		} else {
			$this->modalId = $modalId;
			return true;
		}
	}

	/**
	 * Get modal id
	 *
	 * @return string
	 */
	public function getModalId()
	{
		return $this->modalId;
    }

    /**
	 * Set button id
	 *
	 * @param string $id
	 * @return boolean
	 */
	public function setId($id) 
	{
		if (!is_string($id)) {
			return false;
		} else {
			$this->id = $id;
			return true;
		}
	}

	/**
	 * Get button id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
    }

    /**
	 * Set onclick property
	 *
	 * @param string $class
	 * @return boolean
	 */
	public function setOnclick($onclick) 
	{
		if (!is_string($onclick)) {
			return false;
		} else {
			$this->onclick = $onclick;
			return true;
		}
	}

	/**
	 * Get onclick property
	 *
	 * @return string
	 */
	public function getOnclick()
	{
		return $this->onclick;
    }

    /**
     * Return the button html source code
     *
     * @return string
     */
    public function html()
    {
        switch ($this->type) {
            case Panel::DEFAULT:
                $this->class .= " btn-default";
                break;

            case Panel::PRIMARY:
                    $this->class .= " btn-primary";
                    break;

            case Panel::INFO:
                    $this->class .= " btn-info";
                    break;

            case Panel::SUCCESS:
                    $this->class .= " btn-success";
                    break;

            case Panel::WARNING:
                    $this->class .= " btn-warning";
                    break;

            case Panel::DANGER:
                    $this->class .= " btn-danger";
                    break;

            case Panel::LINK:
                    $this->class .= " btn-link";
                    break;
            
            default:
                $this->class .= " btn-default";
                break;
        }

        $html = "<button type='button' class='btn {$this->class}'".($this->id?" id='{$this->id}'":null);
        
        if (strlen($this->tooltip)) {
            $html .= " data-toggle='tooltip' title=\"{$this->tooltip}\"";
        } 
        
        if (strlen($this->modalId)) {
            $html .= " data-toggle='modal' data-target='#{$this->modalId}'";
        }

        if (strlen($this->onclick)) {
            $html .= " onclick=\"{$this->onclick}\"";
        }

        $html .= ">{$this->text}</button>";
        
        return $html;
    }
}