<?php

namespace App\Database;

use App\App;

class PdoDatabase
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost:3306;dbname=tmsconsuams', 'root', '');
    }

    public function query($sql)
    {
        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        if ($result) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

}