<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 18/07/2016 15:54
 * Copyright etech consulting 2016
 */

namespace App\Model;

use App\Database\PdoDatabase;

class MissionModel
{

    private $database;

    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    public function getMissions()
    {
        $sql = "SELECT * 
                FROM tab_mission
                INNER JOIN tab_entreprise
                ON tab_mission.ENTREPRISE_ID = tab_entreprise.ENTREPRISE_ID
                ORDER BY MISSION_ID DESC";
        return $this->database->query($sql);
    }
}