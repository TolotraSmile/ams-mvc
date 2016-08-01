<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:35
 * Copyright etech consulting 2016
 */

namespace App\Helpers\Facades;


trait TableFacade
{
    public static function surround($item, $tag, $attributes = [])
    {
        $attr = self::getAttributes($attributes);
        return "<$tag $attr>$item</$tag>";
    }

    public static function surrounds($items, $tag, $attributes = [])
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

    public static function getAttributes($attributes = [])
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
}