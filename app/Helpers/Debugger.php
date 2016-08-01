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
        print '<pre>' . print_r($data != null ? $data : 'VAR IS NULL', true) . '</pre>';
    }

    /**
     *
     */
    public static function dd()
    {
        $args = func_get_args();

        if (count($args) === 1) {
            $args = $args[0];
            self::debug($args);
        } else {
            print '<pre>';

            foreach ($args as $arg) {
                print print_r($arg != null ? $arg : 'VAR IS NULL', true) . '<br/>-----------------<br/>';
            }
            print '</pre>';
        }
        die();
    }

    public static function json($data)
    {
        print json_encode($data);
    }
}