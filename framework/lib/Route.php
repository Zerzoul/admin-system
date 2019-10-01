<?php

namespace framework;


class Route
{

    private $_matches;
    private $_routes;
    private $_path;
    private $_function;
    private $_id = null;
    private $_matchId = null;
    private $_type = null;
    private $_matchType = null;

    public function __construct($routes)
    {
        $this->_path = trim($routes['path'], '/');
        $this->_routes = $routes;
    }

    public function match($url)
    {
        $url = trim($url, '/');
        $urlParse = explode('-', $url);
        $pathParse = explode('-', $this->_path);

        $regex = "#^$pathParse[0]$#i";
        if (!preg_match($regex, $urlParse[0], $matches)) {
            return false;
        }

        $this->_matches = $matches;
        for ($i = 0; count($this->_routes) - 1 > $i; $i++) {
            $this->_function[] = $this->_routes[$i];
        }
        $this->splitParams($urlParse);
        return true;
    }

    public function splitParams($urlParse)
    {
        foreach ($urlParse as $params) {
            if (isset($_SESSION['admin'])) {
                if (preg_match('/[0-9]*/', $params, $id)) {
                    if (!empty($id[0])) {
                        $id = $id[0];
                        $this->_matchId = intval($id);
                    }
                };
            } else {

                if (preg_match('/[A-Za-z=]*/', urldecode($params), $id)) {
                    if (!empty($id[0])) {
                        $id = base64_decode($id[0]);
                        $this->_matchId = intval($id);
                    }
                };
            }
        }
        foreach ($urlParse as $params) {
            if (preg_match('/news|episodes|chapitre/', $params, $type)) {
                if (!empty($type[0])) {
                    $this->_matchType = htmlspecialchars($type[0]);
                }
            };
        }
        if (is_string($this->_matchType)) {
            $this->_type = $this->_matchType;
        }

        if (is_int($this->_matchId)) {
            $this->_id = $this->_matchId;
        }

    }

    public function call()
    {
        return array(
            'path' => $this->_matches,
            'function' => $this->_function,
            'params' => [
                'type' => $this->_type,
                'id' => $this->_id,
            ]
        );
    }

}