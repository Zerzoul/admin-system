<?php

namespace framework;

class Config
{

    private $_settings = [];

    public function __construct($config)
    {
        $this->_settings = require dirname(__DIR__) . '\config' . $config . '.php';
    }


    public function get($key)
    {
        if (!isset($this->_settings[$key])) {
            return null;
        }
        return $this->_settings[$key];
    }

    public function getAll()
    {
        return $this->_settings;
    }
}