<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:35
 * Copyright etech consulting 2016
 */

namespace App\Helpers\Facades;


use App\Helpers\Debugger;

trait TableFacade
{
    public function surround($item, $tag, $atributes = [])
    {
        $attr = $this->getAttributes($atributes);
        return "<$tag $attr>$item</$tag>";
    }

    public function surrounds($items, $tag, $atributes = [])
    {
        if (is_array($items)) {
            $ret = '';
            foreach ($items as $key) {
                $ret .= $this->surround($key, $tag, $atributes);
            }
            return $ret;
        }
        return $this->surround($items, $tag, $atributes);
    }

    public function getAttributes($attributes = [])
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