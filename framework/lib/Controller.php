<?php

namespace framework;

class Controller
{

    protected $controller;
    protected $app;
    protected $form;
    protected $id = null;
    protected $path = null;
    protected $comAdded = false;

    public function __construct($app, $form, $params)
    {
        $this->authAccess();

        $this->app = $app;
        $this->form = $form;

        if (is_array($params)) {
            $this->id = $params['id'];
            $this->path = $params['path'];
        }

        if (is_null($this->controller)) {
            $split = explode('\\', get_class($this));
            $class_name = end($split);
            $this->controller = $class_name;
        }
        return $this->controller;
    }

    public function authAccess()
    {
        if (isset($_GET['action'])) {
            if (!isset($_SESSION['admin'])) {
                header("Location: ");
            }
        }
    }
}