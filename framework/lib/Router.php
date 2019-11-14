<?php

/**
 * Get the array route config and the url, create a new instance of routes
 * to get routes match and return the $call
 */
namespace framework;

class Router
{
    /**
     * @var
     */
    private $_url;
    /**
     * @var array
     */
    private $_routes = [];

    /**
     * Router constructor.
     * @param $url
     * @param $routes
     */
    public function __construct($url, $routes)
    {
        $this->_url = $url;
        $this->_routes = $routes;

    }

    /**
     * if match return true, get the $call
     * @return array
     * @throws \Exception
     */
    public function run()
    {

        if (!isset($this->_routes)) {
            throw new \Exception(' Routes does not exist ');
        }

        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $routes) {
            $getRoute = new Route($routes);

            if ($getRoute->match($this->_url)) {
                $call = $getRoute->call();
                return $call;
            }
        }
        throw new \Exception('No matching routes');
    }
}