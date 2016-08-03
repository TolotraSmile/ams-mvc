<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:35
 * Copyright etech consulting 2016
 */

namespace App\Helpers;

use App\Helpers\Facades\TableFacade;

class TableHelper extends TableFacade
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
        $this->keys = $keys;
        $this->indexName = $indexName;
        $this->attributes = $attributes;
        $this->attributes[] = ['class' => "u-full-width"];
        $this->primaryKey = $primaryKey;
        $this->extras = $extras;
    }

    /**
     * @return string
     */
    private function getHead()
    {
        $head = ($this->indexName != '') ? self::surround($this->indexName, 'th') : '';
        foreach ($this->keys as $key => $value) {
            $head .= $this->surround($key, 'th');
        }
        $head = self::surround($head, 'tr');
        return self::surround($head, 'thead');
    }

    private $header;

    /**
     * @param $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @param $data
     * @param $attributes
     * @return string
     */
    private function getRow($data, $attributes = [])
    {
        $cells = '';

        $columns = array_merge(array_keys($this->extras), $this->keys);
        $counter = 0;
        foreach ($columns as $key => $value) {

            if (isset($data->$value)) {
                $cells .= self::surround($data->$value, 'td', $attributes);
            } else {
                $cells .= self::surround($this->extras[$value], 'td', $attributes);
            }
            $counter++;
        }
        return $cells;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        $table = '';
        foreach ($this->data as $item) {
            $cells = $this->getRow($item);

            $attr = [];
            $pk = $this->primaryKey;

            if ($pk != null) {
                $attr = ['id' => $item->$pk];
            }
            $cells = self::surround($cells, 'tr', $attr);
            $table .= $cells;
        }

        $table = self::surround($table, 'tbody');

        return self::surround($this->getHead() . $table, 'table', $this->attributes);
    }
}