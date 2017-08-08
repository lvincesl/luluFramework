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
    private $sourcePath;
    private $sourceCode;
    
    public function __construct($path)
    {
        $this->sourcePath = $path;
        $this->sourceCode = file_get_contents($path);
    }

    /**
     * Return the view source paths
     *
     * @return void
     */
    public function getSourcePath()
    {
        return $this->sourcePath;
    }
    
    /**
     * Return the view source code
     *
     * @return void
     */
    public function getSourceCode()
    {
        return $this->sourceCode;
    }

    /**
     * Set the value of a given variable
     *
     * @param string $variable
     * @param string $value
     * @return void
     */
    public function set($variable, $value)
    {
        $this->sourceCode = str_replace("{%".$name."%}", $value, $this->sourceCode);
    }

    /**
     * Alias of getSourceCode() function
     *
     * @return void
     */
    public function toString()
    {
        return $this->sourceCode;
    }

    /**
     * Print the view
     *
     * @return void
     */
    public function show()
    {
        echo $this->sourceCode;
    }
}
