<?php

namespace framework;

class App
{

    private static $_instance;
    private static $_instanceController = null;
    private static $_instancePage = null;
    private static $_router = null;
    protected $path;
    private $_db_instance;
    private $_routes;
    private $_formBuilder;


    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getManager($name)
    {
        $class = ucfirst($name) . 'Manager';
        $class_path = '../app/models/' . $class;
        $class_name = '\\models\\' . $class;

        require_once $class_path . '.php';
        return new $class_name($this->getDb());
    }

    public function getDb()
    {
        $config = $this->initConfig('\dsn');
        if (is_null($this->_db_instance)) {
            $db = new PDOManager($config->get('name'), $config->get('host'), $config->get('pass'), $config->get('user'));
            $this->_db_instance = $db->MYSQLConnect();
        }
        return $this->_db_instance;
    }

    public function initConfig($config)
    {
        return new Config($config);
    }

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

    public function authAdmin()
    {
        if ($_GET['action']) {
            if (!isset($_SESSION['admin'])) {
                header('Location: login');
                exit();
            }
        }
    }

    public function initForm()
    {
        if (is_null($this->_formBuilder)) {
            $form = new Form();
            $this->_formBuilder = $form;
        }
        return $this->_formBuilder;
    }


    public function initRouter($url, $routes)
    {
        $routes = $this->initConfig($routes);
        $this->_routes = $routes->getAll();
        if (is_null(self::$_router)) {
            self::$_router = new Router($url, $this->_routes);
        }
        return self::$_router;
    }

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
    public function getApi($call)
    {
        if (!isset($call)) {
            throw new \Exception('No data to get');
        }
        $this->path = $call['path'];
        return new getApi($call, self::getInstance());

    }


}
