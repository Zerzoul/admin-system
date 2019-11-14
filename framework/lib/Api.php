<?php
/**
 * Class get, and format data for the REST API
 */

namespace framework;


class Api
{
    /**
     * Instance of app
     * @var
     */
    protected $app;
    /**
     * Stock function who need to be called
     * @var mixed
     */
    private $_function;
    private $_id = null;
    private $_path = null;
    /**
     * Object returning data.
     * @var null|object
     */
    protected $data = null;

    /**
     * Api constructor.
     * @param $call
     * @param $app
     */
    public function __construct($call, $app)
    {
        $this->app = $app;
        $this->_function = $call['function'];
        $this->_id = $call['params']['id'];
        $this->_path = $call['path'][0];

        $this->getHeader();
    }

    /**
     * exe the right method in function of is request method
     */
    protected function getHeader(){
        $request = $_SERVER['REQUEST_METHOD'];
        if ($request === 'GET'){
            $this->read();
        }
        if ($request === 'POST'){
            $this->create();
        }
    }

    /**
     * POST resquest
     */
    protected function create(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json, text/plain, */*');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type');

        $this->fetchController();
    }

    /**
     * GET resquest
     */
    protected function read(){
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $this->fetchController();
    }
    /**
     * Format and stock JSON into $data
     * @return object
     */
    public function getData(){
        $data = json_encode($this->data);
        return $data;
    }

    /**
     * fetch the controller and the method define into $call
     * stock into the data the return of the method
     */
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