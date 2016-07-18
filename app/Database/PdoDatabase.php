<?php

namespace App\Database;

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
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

}