<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:35
 * Copyright etech consulting 2016
 */

namespace App\Helpers;

use App\Helpers\Facades\TableFacade;

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
    private $attributes;

    private $primaryKey;
    /**
     * @var array
     */
    private $extras;

    use TableFacade;

    /**
     * TableHelper constructor.
     * @param array $data
     * @param array $keys
     * @param string $indexName
     * @param array $attributes
     * @param null $primaryKey
     * @param array $extras
     */
    public function __construct($data = [], $keys = [], $indexName = '', $attributes = [], $primaryKey = null, $extras = [])
    {
        $this->data = $data;
        $this->keys = array_merge($keys, $extras);
        $this->indexName = $indexName;
        $this->attributes = $attributes;
        $this->attributes[] = ['class' => "u-full-width"];
        $this->primaryKey = $primaryKey;
        $this->extras = $extras;


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

    public function getTable()
    {
        $table = '';
        $counter = 1;
        foreach ($this->data as $item) {
            $cells = '';
            if ($this->indexName != '') {
                $cells .= $this->surround($counter . '', 'td');
            }

            $cell = 0;

            foreach ($this->keys as $key => $value) {

                if (isset($this->extras) && isset($this->extras[$key])) {
                    $cells .= $this->surround($this->extras[$cell], 'td');
                }

                if (is_string($value)) {
                    $cells .= $this->surround($item->$value, 'td');
                } else {
                    $sub = '';
                    foreach ($value as $subvalue) {
                        $sub .= $item->$subvalue . ' - ';
                    }
                    $cells .= $this->surround($sub, 'td');
                }
                $cell++;
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

        return $this->surround($this->getHead() . $table, 'table', $this->attributes);
    }
}