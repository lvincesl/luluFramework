<?php

namespace Luluframework\Client\View\Table\Row;

class Option
{
    const VIEW      = 0;
    const EDIT      = 1;
    const DUPLICATE = 2;
    const DELETE    = 3;
    const PROCESS   = 4;
    const PRINT     = 5;

    private $rowId;
    private $type;
    private $link;
    private $class;

    /**
     * Constructor
     *
     * @param integer $type
     * @param string $rowId
     */
    public function __construct($type, $rowId, $link=null)
    {
        if (!is_integer($type)) {
            throw new \Exception("InvalidArgumentException : integer expected for 'type' !");
        } elseif (  $type != Option::VIEW &&
                    $type != Option::EDIT &&
                    $type != Option::DUPLICATE &&
                    $type != Option::DELETE &&
                    $type != Option::PROCESS &&
                    $type != Option::PRINT) {
            throw new \Exception("UnexpectedValueException : unknown 'type' !");
        } elseif (!\is_string($rowId)) {
            throw new \Exception("InvalidArgumentException : string expected for 'rowId' !");
        } elseif (!is_null($link) && !is_string($link)) {
            throw new \Exception("InvalidArgumentException : string expected for 'link' !");          
        } else {
            $this->type     = $type;
            $this->rowId    = $rowId;
            $this->link     = $link;
            $this->class    = null;
        }
    }

    /**
     * Set option hyperlink
     *
     * @return boolean
     */
    public function setLink($link)
    {
        if (!is_string($link)) {
            return false;
        } else {
            $this->link = $link;
            return true;
        }
    }

    /**
     * Get option link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Get option html source code
     *
     * @return void
     */
    public function html()
    {
        switch ($this->type) {
            case self::VIEW:
                return "<a href='#'  data-toggle='tooltip' title='View' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ view : \"{$this->rowId}\");'><i class='fa fa-info' aria-hidden='true'></i></a>";
                break;

            case self::EDIT:
                return "<a href='#'  data-toggle='tooltip' title='Edit' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ edit : \"{$this->rowId}\");'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                break;            

            case self::DUPLICATE:
                return "<a href='#'  data-toggle='tooltip' title='Copy/Paste' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ copy : \"{$this->rowId}\");'><i class='fa fa-clone' aria-hidden='true'></i></a>";
                break;
            
            case self::DELETE:
                return "<a href='#'  data-toggle='tooltip' title='Delete' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ delete : \"{$this->rowId}\");'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                break;
            
            case self::PROCESS:
                return "<a href='#'  data-toggle='tooltip' title='Process' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ process : \"{$this->rowId}\");'><i class='fa fa-check' aria-hidden='true'></i></a>";
                break;
            
            case self::PRINT:
                return "<a href='#'  data-toggle='tooltip' title='Print' class='uk-button uk-button-small {$this->class}' role='button' onclick='$.redirect(\"{$this->link}\",{ print : \"{$this->rowId}\");'><i class='fa fa-print' aria-hidden='true'></i></a>";
                break;
            
            
            default:
                return null;
                break;
        }
    }

}