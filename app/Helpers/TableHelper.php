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
     * @var string
     */
    private $indexName;
    /**
     * @var array
     */
    private $extras;

    private $primaryKey;

    /**
     * TableHelper constructor.
     * @param array $data
     * @param array $keys
     * @param string $indexName
     * @param array $extras
     * @param null $primaryKey
     */
    public function __construct($data = [], $keys = [], $indexName = '', $extras = [], $primaryKey = null)
    {
        $this->data = $data;
        $this->keys = $keys;
        $this->indexName = $indexName;
        $this->extras = $extras;
        $this->extras[] = ['class' => "u-full-width"];
        $this->primaryKey = $primaryKey;
    }

    private function getHead()
    {
        $head = ($this->indexName != '') ? $this->surround($this->indexName, 'th') : '';
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
        $counter = 1;
        foreach ($this->data as $item) {
            $cells = '';
            if ($this->indexName != '') {
                $cells .= $this->surround($counter . '', 'td');
            }
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
            $counter++;
            $attr = [];
            $pk = $this->primaryKey;

            if ($pk != null) {
                $attr = ['id' => $item->$pk];
            }
            $cells = $this->surround($cells, 'tr', $attr);
            $table .= $cells;
        }

        $table = $this->surround($table, 'tbody');

        return $this->surround($this->getHead() . $table, 'table', $this->extras);
    }
}