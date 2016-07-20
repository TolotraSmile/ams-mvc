<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 20/07/2016 09:54
 * Copyright etech consulting 2016
 */

namespace App\Helpers;


class Debugger
{
    /**
     * @param $data
     */
    public static function debug($data)
    {
        if ($data != null) {
            print '<pre>' . print_r($data, true) . '</pre>';
        } else {
            print_r('<pre>VAR IS NULL</pre>');
        }
    }

    /**
     * @param $data
     */
    public static function dd($data)
    {
        self::debug($data);
        die();
    }
}