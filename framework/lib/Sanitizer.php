<?php
namespace framework;


class Sanitizer
{
    private $_call;

    public function __construct($call)
    {
        $this->_call = $call;
    }

    public function sanitizeParams()
    {
        $id = $this->checkId($this->_call['params']['id']);
        $path = $this->checkThePath($this->_call['path'][0]);

        if ($id === false || $path === false) {
            throw new \Exception('The params of the are not correct');
        }
    }

    private function checkId($id)
    {
        if (!is_null($id)) {
            if (is_int($id)) {
                return true;
            }
            return false;
        }
        return null;
    }

    private function checkThePath($path)
    {
        if (isset($path) && is_string($path)) {
            return true;
        }
        return false;
    }

}