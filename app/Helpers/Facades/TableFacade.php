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
    public function surround($item, $tag, $atributes = [])
    {
        $attr = $this->getAttributes($atributes);
        return "<$tag $attr>$item</$tag>";
    }

    public function getAttributes($attributes = [])
    {
        if (empty($attributes)) return '';
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