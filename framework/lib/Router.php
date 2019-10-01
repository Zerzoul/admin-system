<?php

namespace framework;

class Router
{

    private $_url;
    private $_routes = [];

    public function __construct($url, $routes)
    {
        $this->_url = $url;
        $this->_routes = $routes;

    }

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