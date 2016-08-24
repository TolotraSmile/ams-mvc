<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:33
 * Copyright etech consulting 2016
 */

namespace App\Model;


use App\App;
use App\Helpers\Debugger;

class Model
{
    protected $database;
    protected $tableName = '';

    public function __construct()
    {
        $this->database = App::getInstance()->getPdo();;
    }

    /**
     * @param $array
     * @return string
     */
    protected function normalize($array)
    {
        return is_array($array) ? ' IN (' . implode(',', $array) . ') ' : ' = ' . $array . ' ';
    }


    /**
     * @param $data
     * @return array|bool|\PDOStatement
     */
    public function insert($data)
    {
        $data = $this->implodeArray($data);
        $columns = $data['columns'];
        $values = $data['values'];

        $sql = "INSERT INTO $this->tableName ($columns) VALUES ($values)";
        return $this->database->query($sql);
    }

    /**
     * @param $data
     * @param $condition
     * @return array|bool|\PDOStatement
     */
    public function update($data, $condition)
    {
        $columns = '';

        foreach ($data as $key => $value) {
            $columns .= "$key='$value',";
        }

        $columns = substr($columns, 0, strlen($columns) - 1);

        if (!empty($columns)) {
            $sql = "UPDATE $this->tableName SET $columns WHERE $condition";
            return $this->database->query($sql);
        }
        return false;
    }

    protected function implodeArray($data)
    {
        $values = array();
        foreach (array_values($data) as $value) {
            $values[] = "'$value'";
        }
        return array('columns' => implode(', ', array_keys($data)), 'values' => implode(', ', $values));
    }

}