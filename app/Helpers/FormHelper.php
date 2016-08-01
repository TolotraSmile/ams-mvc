<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 20/07/2016 11:46
 * Copyright etech consulting 2016
 */

namespace App\Helpers;

class FormHelper
{
    public static function surround($item, $tag, $attributes = array())
    {
        $attr = self::getAttributes($attributes);
        return "<$tag $attr>$item</$tag>";
    }

    public static function surrounds($items, $tag, $attributes = array())
    {
        if (is_array($items)) {
            $ret = '';
            foreach ($items as $key) {
                $ret .= self::surround($key, $tag, $attributes);
            }
            return $ret;
        }
        return self::surround($items, $tag, $attributes);
    }

    public static function getAttributes($attributes = array())
    {
        if (empty($attributes) && is_array($attributes)) return '';
        $attr = ' ';
        foreach ($attributes as $key => $value) {
            if (is_string($key)) {
                $attr .= is_array($value) ? "$key=\"" . implode(' ', $value) . "\"" : "$key=\"$value\"";
            }
            $attr .= ' ';
        }
        return $attr;
    }

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