<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:33
 * Copyright etech consulting 2016
 */

namespace App\Model;


use App\Database\PdoDatabase;

class Model
{
    protected $database;

    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }
}