<?php
/**
 * Parent manager
 */
namespace framework;

class Manager
{
    /**
     * Code for article publication
     */
    /*PUBLICATION STATUE POST*/
    const PUBLISHED = 1;
    const VALIDATION_BEFORE = 2;
    const ROUGH = 3;

    /**
     * Code for comments publication
     */
    /*PUBLICATION STATUE COMS*/
    const COM_VALID = 4;
    const COM_IGNORE = 5;
    const COM_NEW = 6;

    /**
     * Code for
     */
    const USER_ACTIF = 7;
    const USER_BANNED = 8;

    /*STATUE USER*/
    /**
     * @var
     */
    protected $pdo;
    /**
     * @var mixed
     */
    protected $manager;

    /**
     * Manager constructor.
     * @param $dbConnect
     */
    public function __construct($dbConnect)
    {
        $this->pdo = $dbConnect;

        if (is_null($this->manager)) {
            $split = explode('\\', get_class($this));
            $class_name = end($split);

            $this->manager = $class_name;
        }
        return $this->manager;
    }
}
