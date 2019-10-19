<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 01/10/2019
 * Time: 22:04
 */

namespace framework;


class Api
{
    protected $app;
    private $_function;
    private $_id = null;
    private $_path = null;
    protected $data = null;

    public function __construct($call, $app)
    {
        $this->app = $app;
        $this->_function = $call['function'];
        $this->_id = $call['params']['id'];
        $this->_path = $call['path'][0];

        $this->getHeader();
    }
    protected function getHeader(){
        $request = $_SERVER['REQUEST_METHOD'];
        if ($request === 'GET'){
            $this->read();
        }
        if ($request === 'POST'){
            $this->create();
        }
    }
    protected function create(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Request-With');

        $this->fetchController();
    }
    protected function read(){
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $this->fetchController();
    }
    public function getData(){
        $data = json_encode($this->data);
        return $data;
    }
    protected function fetchController()
    {
        $function = $this->_function;
        $params = [
            'id' => $this->_id,
            'path' => $this->_path
        ];
        $getTheController = $this->app->getController($function[0]['controller'], 'api', $params);

        if (!is_null($function[0]['method'])) {
            $method = $function[0]['method'];
            $this->data = $getTheController->$method();
        }
    }
}