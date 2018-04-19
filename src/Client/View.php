<?php
namespace Luluframework\Client;


/**
 * View handler class
 *
 * @package  LuluFramework\Client
 * @author   Lionel Vinceslas <lionel.vinceslas@laposte.net>
 * @license  CECILL http://www.cecill.info/licences/Licence_CeCILL-C_V1-fr.txt
 * @link     http://www.lionelvinceslas.xyz
 *
 * @date 02/09/2007
 */
class View
{
    private $path;
    private $html;
    
    /**
     * Constructor
     *
     * @param string $path
     */
    public function __construct($path=null)
    {
        if (!is_null($path) && !is_string($path)) {
            throw new Exception('TypeError');
        } else {
            $this->path = $path;
            $this->html = ($path?file_get_contents($path):null);
        }
    }

    /**
     * Set view path
     *
     * @param string $path
     * @return true
     */
    public function setPath($path)
    {
        if (!is_string($path)) {
            return false;
        } else {
            $this->path = $path;
            $this->html = file_get_contents($path);
            return true;
        }
    }

    /**
     * Get view path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Update variable
     *
     * @param string $variable
     * @param string $value
     * @return boolean
     */
    public function update($variable, $value = null)
    {
        if (!is_string($variable)) {
            return false;
        } elseif (!is_null($value) && !is_string($value)) {
            return false;
        } else {
            $this->html = str_replace("{%$variable%}", $value, $this->html);
            return true;
        }
    }

    /**
     * Alias of getSourceCode() function
     *
     * @return string
     */
    public function html()
    {
        return $this->html;
    }

    /**
     * Display the view
     *
     * @return boolean
     */
    public function display()
    {
        echo $this->html;
        return true;
    }
}