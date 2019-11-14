<?php
/**
 * Check data from the $call
 */
namespace framework;

class Sanitizer
{
    /**
     * @var
     */
    private $_call;

    /**
     * Sanitizer constructor.
     * @param $call
     */
    public function __construct($call)
    {
        $this->_call = $call;
    }

    /**
     * @throws \Exception
     */
    public function sanitizeParams()
    {
        $id = $this->checkId($this->_call['params']['id']);
        $path = $this->checkThePath($this->_call['path'][0]);

        if ($id === false || $path === false) {
            throw new \Exception('The params of the are not correct');
        }
    }

    /**
     * @param $id
     * @return bool|null
     */
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

    /**
     * @param $path
     * @return bool
     */
    private function checkThePath($path)
    {
        if (isset($path) && is_string($path)) {
            return true;
        }
        return false;
    }

}