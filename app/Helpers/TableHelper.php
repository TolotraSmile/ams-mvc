<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:35
 * Copyright etech consulting 2016
 */

namespace App\Helpers;

class TableHelper
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var array
     */
    private $keys;

    /**
     * TableHelper constructor.
     * @param array $data
     * @param array $keys
     */
    public function __construct($data = [], $keys = [])
    {
        $this->data = $data;
        $this->keys = $keys;
    }

    private function getHead()
    {
        $head = '';
        foreach ($this->keys as $key => $value) {
            $head .= $this->surround($key, 'th');
        }
        $head = $this->surround($head, 'tr');
        return $this->surround($head, 'thead');
    }

    private function surround($item, $tag, $atributes = [])
    {
        $attr = $this->getAttributes($atributes);
        return "<$tag $attr>$item</$tag>";
    }

    private function getAttributes($attributes = [])
    {
        if (empty($attributes)) return '';
        $attr = ' ';
        foreach ($attributes as $key => $value) {
            if (is_string($key)) {
                if (is_array($value)) {
                    $attr .= "$key=\"" . implode(' ', $value) . "\"";
                } else {
                    $attr .= "$key=\"$value\"";
                }
            }
            $attr .= ' ';
        }
        return $attr;
    }

    public function getTable()
    {
        $table = '';

        foreach ($this->data as $item) {
            $cells = '';
            foreach ($this->keys as $key => $value) {
                if (is_string($value)) {
                    $cells .= $this->surround($item->$value, 'td');
                } else {
                    $sub = '';
                    foreach ($value as $subvalue) {
                        $sub .= $item->$subvalue . ' - ';
                    }
                    $cells .= $this->surround($sub, 'td');
                }
            }
            $cells = $this->surround($cells, 'tr');
            $table .= $cells;
        }

        $table = $this->surround($table, 'tbody');

        $attributes = ['class' => "u-full-width", 'style' => 'margin: 20px;'];
        return $this->surround($this->getHead() . $table, 'table', $attributes);
    }
}