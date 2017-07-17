<?php
namespace Luluframework\Server;

use Klein\Klein;

class Router extends Klein
{
    private $routesFile;
    private $routes;

    public function __construct()
    {
        $this->routesFile = null;
        $this->routes = null;
    }

    /**
     * Set routes file
     *
     * @param string $routesFile
     * @return void
     */
    public function setRoutesFile($routesFile)
    {
        $this->routesFile = $routesFile;
    }
    
    /**
     * Dispatch the client request
     *
     * @return void
     */
    public function dispatch()
    {
        $parent->dispatch();
    }
}