<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 18/07/2016 15:55
 * Copyright etech consulting 2016
 */

namespace App;

class App
{
    private $pdo;
    private static $instance;

    /**
     * App constructor.
     */
    function __construct()
    {
        $this->pdo = new Database\PdoDatabase();
    }

    /**
     * @return App
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    /**
     * @return Database\PdoDatabase
     */
    public function getPdo()
    {
        return self::getInstance()->pdo;
    }


}