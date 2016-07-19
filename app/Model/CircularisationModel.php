<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:32
 * Copyright etech consulting 2016
 */

namespace App\Model;


use App\Database\PdoDatabase;

class CircularisationModel
{
    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    public function getFournisseurs()
    {
        $sql = "SELECT * 
                FROM tab_mission
                INNER JOIN tab_entreprise
                ON tab_mission.ENTREPRISE_ID = tab_entreprise.ENTREPRISE_ID
                ORDER BY MISSION_ID DESC";
        return $this->database->query($sql);
    }
}