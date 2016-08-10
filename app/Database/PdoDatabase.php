<?php

namespace App\Database;

use App\App;
use App\Helpers\Debugger;

class PdoDatabase
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost:3306;dbname=tmsconsuams', 'root', '');
    }

    public function query($sql)
    {
        $sql = trim($sql);

        if (strpos('INSERT', $sql) === 0 || strpos('UPDATE', $sql) === 0 || strpos('DELETE', $sql) === 0) {
            return $this->pdo->query($sql);
        }

        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        if ($result) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

}