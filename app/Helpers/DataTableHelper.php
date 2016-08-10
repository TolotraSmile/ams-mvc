<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:20
 * Copyright etech consulting 2016
 */

namespace App\Helpers;


use App\Helpers\Facades\TableFacade;

class DataTableHelper extends TableFacade
{
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
    private function getRow($data, $attributes = array())
    {
        $cells = '';
        foreach ($this->keys as $key => $value) {

            if (is_array($value)) {
                $attributes[] = $value[1];
                $cells .= self::surround($data->$value[0], 'td', $attributes);
            } else {
                if (isset($data->$value)) {
                    $cells .= self::surround($data->$value, 'td', $attributes);
                } else {
                    $cells .= self::surround($value, 'td', $attributes);
                }
            }
        }
        return $cells;
    }

    public function getTable()
    {

        $table = '';
        foreach ($this->data as $item) {
            $cells = $this->getRow($item);

            $attr = array();

            $pk = $this->primaryKey;

            if ($pk != null) {
                $attr = array('id' => $item->$pk);
            }

            $cells = self::surround($cells, 'tr', $attr);
            $table .= $cells;
        }

        $table = self::surround($table, 'tbody');

        return self::surround($this->getHeader() . $table, 'table', $this->attributes);
    }

    /**
     * @return string
     */
    private function getHeader()
    {
        $head = '';
        foreach ($this->header as $key) {
            $head .= self::surround($key, 'th');
        }
        $head = self::surround($head, 'tr');
        return self::surround($head, 'thead');
    }

}