<?php
/**
 * fetch and return array config when is needed
 */
namespace framework;

class Config
{
    /**
     * @var array|mixed
     */
    private $_settings = [];

    /**
     * Config constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->_settings = require dirname(__DIR__) . '/config/' . $config . '.php';
    }

    /**
     * return one of this array
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (!isset($this->_settings[$key])) {
            return null;
        }
        return $this->_settings[$key];
    }

    /**
     * return all data of this array
     * @return array|mixed*
     */
    public function getAll()
    {
        return $this->_settings;
    }
}