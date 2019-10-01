<?php

namespace framework;

class Autoloader
{

    public static function register()
    {
        spl_autoload_register(array(__class__, 'autoload'));
    }

    public static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            require __DIR__ . '/' . $class . '.php';
        }

    }
}