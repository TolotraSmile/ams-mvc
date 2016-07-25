<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:33
 * Copyright etech consulting 2016
 */

namespace App\Model;


use App\App;

class Model
{
    protected $database;

    public function __construct()
    {
        $this->database = App::getInstance()->getPdo();;
    }

    /**
     * @param $array
     * @return string
     */
    protected function normalize($array)
    {
        return is_array($array) ? 'IN (' . implode(',', $array) . ') ' : ' = ' . $array . ' ';
    }
}