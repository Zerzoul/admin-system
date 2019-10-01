<?php

namespace framework;


class Page
{

    protected $app;
    private $_function;
    private $_id = null;
    private $_type = null;
    private $_path = null;

    public function __construct($call, $app)
    {
        $this->sanitizeParams($call);
        $this->app = $app;
        $this->_function = $call['function'];
    }

    public function sanitizeParams($call)
    {
        $id = $this->checkId($call['params']['id']);
        $type = $this->checkType($call['params']['type']);
        $path = $this->checkThePath($call['path'][0]);

        if ($id === false || $type === false || $path === false) {
            throw new \Exception('The params of the are not correct');
        }
        $this->_id = $call['params']['id'];
        $this->_type = $call['params']['type'];
        $this->_path = $call['path'][0];
    }

    public function checkId($id)
    {
        if (!is_null($id)) {
            if (is_int($id)) {
                return true;
            }
            return false;
        }
        return null;
    }

    public function checkType($type)
    {
        if (!is_null($type)) {
            if (is_string($type)) {
                return true;
            }
            return false;
        }
        return null;
    }

    public function checkThePath($path)
    {
        if (isset($path) && is_string($path)) {
            return true;
        }
        return false;
    }

    public function build($direction)
    {
        $function = $this->_function;
        $params = [
            'id' => $this->_id,
            'type' => $this->_type,
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