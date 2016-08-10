<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 20/07/2016 11:46
 * Copyright etech consulting 2016
 */

namespace App\Helpers;

use App\Helpers\Facades\TableFacade;

class FormHelper extends TableFacade
{
    /**
     * @param $items
     * @param array $attributes
     * @return string
     */
    public static function getTableHeader($items, $attributes = array())
    {
        $head = '';
        foreach ($items as $key) {
            $head .= self::surround($key, 'th');
        }
        $head = self::surround($head, 'tr');
        return self::surround($head, 'thead', $attributes);
    }

    public static function input($type, $attributes = array())
    {
        return '<input type="' . $type . '" ' . self::getAttributes($attributes) . '/>';
    }

}