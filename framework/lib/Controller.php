<?php
/**
 * Parent controller
 */
namespace framework;

class Controller
{
    /**
     * @var mixed
     */
    protected $controller;
    /**
     * instance of app
     * @var
     */
    protected $app;
    /**
     * form generator
     * @var
     */
    protected $form;

    protected $id = null;
    protected $path = null;
    protected $comAdded = false;

    /**
     * Controller constructor.
     * @param $app
     * @param $form
     * @param $params
     */
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

    /**
     * Controle the authentification is still set
     */
    public function authAccess()
    {
        if (isset($_GET['action'])) {
            if (!isset($_SESSION['admin'])) {
                header("Location: ");
            }
        }
    }
}