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
        Debugger::debug($sql);

        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        if ($result) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
        return false;
    }

}