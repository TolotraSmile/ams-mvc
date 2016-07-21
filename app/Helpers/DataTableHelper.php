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
    private $data;
    private $keys;
    private $extras;

    use TableFacade;

    /**
     * DataTableHelper constructor.
     * @param $data
     * @param $keys
     * @param $extras
     */
    public function __construct($data, $keys, $extras)
    {
        $this->data = $data;
        $this->keys = $keys;
        $this->extras = $this->setExtra($extras);
    }

    public function setExtra($extras = [])
    {
        if (isset($extras) && is_array($extras) && !empty($extras)) {
            $this->extras = $extras;
        }
    }

    public function setRow($rowdata, $others, $attributes)
    {
        if (empty($rowdata) && empty($others)) return '';
        $row = '';
        $index = 0;
        foreach ($rowdata as $item) {
            if (isset($index) && isset($others[$index])) {
                $row .= $this->surround($others[$index], 'tb', $attributes);
            }
            $row .= $this->surround($item, 'tb', $attributes);
        }
        return $row;
    }


}