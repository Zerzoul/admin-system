<?php

namespace framework;

class App
{
    /**
     *
     * @var
     */
    private static $_instance;
    /**
     * @var null
     */
    private static $_instanceController = null;
    /**
     * @var null
     */
    private static $_instancePage = null;
    /**
     * @var null
     */
    private static $_router = null;
    /**
     * @var
     */
    protected $path;
    /**
     * @var
     */
    private $_db_instance;
    /**
     * @var
     */
    private $_routes;
    /**
     * @var
     */
    private $_formBuilder;

    /**
     * App is a singleton stock and return is unique instance
     * @return App
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Called by the controller to fetch data from DB
     * @param $name
     * @return mixed
     */
    public function getManager($name)
    {
        $class = ucfirst($name) . 'Manager';
        $class_path = '../app/models/' . $class;
        $class_name = '\\models\\' . $class;

        require_once $class_path . '.php';
        return new $class_name($this->getDb());
    }

    /**
     * Create the connection to data Base with the dsn array
     * @return \PDO
     */
    public function getDb()
    {
        $config = $this->initConfig('dsn');
        if (is_null($this->_db_instance)) {
            $db = new PDOManager($config->get('name'), $config->get('host'), $config->get('pass'), $config->get('user'));
            $this->_db_instance = $db->MYSQLConnect();
        }
        return $this->_db_instance;
    }

    /**
     * return instance of config class by passing asked array
     * @param $config
     * @return Config
     */
    public function initConfig($config)
    {
        return new Config($config);
    }

    /**
     * Is a factory for instanciate new controller classes
     * @param $name
     * @param $direction
     * @param $params
     * @return null
     */
    public function getController($name, $direction, $params)
    {
        $class = ucfirst($name) . 'Controller';
        $direction = strtolower($direction);
        $class_path = '../app/controllers/' . $direction . '/' . $class;
        $class_name = '\\controllers\\' . $direction . '\\' . $class;
        $form = $this->initForm();
        require_once $class_path . '.php';
        if (self::$_instanceController instanceof $class_name === false) {
            self::$_instanceController = new $class_name(self::getInstance(), $form, $params);
        }
        return self::$_instanceController;
    }

    /**
     * Controle the authentification when it's called
     */
    public function authAdmin()
    {
        if ($_GET['action']) {
            if (!isset($_SESSION['admin'])) {
                header('Location: login');
                exit();
            }
        }
    }

    /**
     * Create a new instance of the form generator admin side
     * @return Form
     */
    public function initForm()
    {
        if (is_null($this->_formBuilder)) {
            $form = new Form();
            $this->_formBuilder = $form;
        }
        return $this->_formBuilder;
    }

    /**
     * Instanciate a new route class
     * @param $url
     * @param $routes
     * @return Router|null
     */
    public function initRouter($url, $routes)
    {
        $routes = $this->initConfig($routes);
        $this->_routes = $routes->getAll();
        if (is_null(self::$_router)) {
            self::$_router = new Router($url, $this->_routes);
        }
        return self::$_router;
    }

    /**
     * Return a new instance of the upload class
     * @param $file
     * @return Upload
     */
    public function upload($file){
        return new Upload($file);
    }

    /**
     * create and return a new instance of page class
     * @param $call
     * @return Page|null
     * @throws \Exception
     */
    public function getPage($call)
    {
        if (!isset($call)) {
            throw new \Exception('No page to build');
        }
        $this->path = $call['path'];
        if (is_null(self::$_instancePage)) {
            self::$_instancePage = new Page($call, self::getInstance());
        }
        return self::$_instancePage;
    }

    /**
     * create and return a new instance of api class
     * @param $call
     * @return Api
     * @throws \Exception
     */
    public function api($call)
    {
        if (!isset($call)) {
            throw new \Exception('No data to get');
        }
        $this->path = $call['path'];
        return new Api($call, self::getInstance());

    }


}
