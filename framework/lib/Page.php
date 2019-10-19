<?php

namespace framework;


class Page
{

    protected $app;
    private $_function;
    private $_id = null;
    private $_path = null;

    public function __construct($call, $app)
    {
        $this->app = $app;
        $this->_function = $call['function'];
        $this->_id = $call['params']['id'];
        $this->_path = $call['path'][0];
    }

    public function build($direction)
    {
        $function = $this->_function;
        $params = [
            'id' => $this->_id,
            'path' => $this->_path
        ];

        for ($i = 0; $i <= count($function) - 1; $i++) {
            $getTheController = $this->app->getController($function[$i]['controller'], $direction, $params);

            if (!is_null($function[$i]['method'])) {
                $method = $function[$i]['method'];
                $getTheController->$method();
            }
        }
    }
}