<?php

namespace Luluframework\Client\View;

class Modal
{
    private $id;
    private $close;
    private $title;
    private $body;
    private $footer;
    private $class;

    public function __construct($id=null)
    {
        $this->id       = $id;
        $this->close    = false;
        $this->title    = null;
        $this->header   = null;
        $this->body     = null;
        $this->footer   = null;
        $this->class    = null;
    }

    /**
     * Set modal id
     *
     * @param string $id
     * @return boolean
     */
    public function setId($id)
    {
        if (!is_string($id))
        {
            return false;
        } else {
            $this->id = $id;
            return true;
        }
    }

    /**
     * Get modal id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Activate header close button
     *
     * @param boolean $boolean
     * @return boolean
     */
    public function close($boolean)
    {
        if (!is_bool($boolean)) {
            return false;
        } else {
            $this->close = $boolean;
            return true;
        }
    }

    /**
     * Set modal title
     *
     * @param string $title
     * @return boolean
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            return false;
        } else {
            $this->title = $title;
            return true;
        }
    }

    /**
     * Get modal title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set modal body
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
     * Set modal footer
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
     * Get modal footer
     *
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
	 * Set modal class
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
	 * Get modal class
	 *
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}

    /**
     * Return the modal html source code
     *
     * @return string
     */
    public function html()
    {
        $html = "<div class='modal {$this->class}' id='{$this->id}' role='dialog'><div class='modal-dialog' role='document'><div class='modal-content'>";
        
        if (strlen($this->title) || $this->close) {
            $html .= "<div class='modal-header'>".
                    ($this->close?"<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>":null).
                    (strlen($this->title)?"<h4 class='modal-title'>{$this->title}</h4>":null).
                    "</div>";
        }

        $html .= "<div class='modal-body'>{$this->body}</div>";

        if (strlen($this->footer)) {
            $html .= "<div class='modal-footer'>{$this->footer}</div>";
        }

        $html .= "</div></div></div>";

        return $html;
    }
}