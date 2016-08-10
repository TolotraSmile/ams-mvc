<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 14:24
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\App;

class Controller
{
    protected $model;
    protected $database;

    public function __construct()
    {
        $this->database = App::getInstance()->getPdo();
    }
}