<?php

namespace framework;

class PDOManager
{

    private $_name;
    private $_host;
    private $_pass;
    private $_user;
    private $_getDb;

    public function __construct($name, $host, $pass, $user)
    {
        $this->_name = $name;
        $this->_host = $host;
        $this->_pass = $pass;
        $this->_user = $user;
    }

    public function MYSQLConnect()
    {
        $pdo = new \PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_name . ';charset=utf8', $this->_user, $this->_pass);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->_getDb = $pdo;

        return $this->_getDb;
    }

}