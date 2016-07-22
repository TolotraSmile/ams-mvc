<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:20
 * Copyright etech consulting 2016
 */

namespace App\Helpers;


use App\Helpers\Facades\TableFacade;

class DataTableHelper
{

    use TableFacade;
    private $data;
    private $keys;
    private $header;
    private $primaryKey;
    private $attributes;

    /**
     * DataTableHelper constructor.
     * @param $data
     * @param $keys
     * @param $header
     * @param $primaryKey
     * @param $attributes
     * @internal param $headers
     * @internal param $extras
     */
    public function __construct($data, $keys, $header, $attributes, $primaryKey)
    {
        $this->data = $data;
        $this->keys = $keys;
        $this->header = $header;
        $this->primaryKey = $primaryKey;
        $this->attributes = $attributes;
    }

    /**
     * @param $data
     * @param $attributes
     * @return string
     */
    private function getRow($data, $attributes = [])
    {
        $cells = '';
        foreach ($this->keys as $key => $value) {
            if (isset($data->$value)) {
                $cells .= $this->surround($data->$value, 'td', $attributes);
            } else {
                $cells .= $this->surround($value, 'td', $attributes);
            }
        }
        return $cells;
    }

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

            $cells = $this->surround($cells, 'tr', $attr);
            $table .= $cells;
        }

        $table = $this->surround($table, 'tbody');

        return $this->surround($this->getHeader() . $table, 'table', $this->attributes);
    }

    /**
     * @return string
     */
    private function getHeader()
    {
        $head = '';
        foreach ($this->header as $key) {
            $head .= $this->surround($key, 'th');
        }
        $head = $this->surround($head, 'tr');
        return $this->surround($head, 'thead');
    }

}