<?php

/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 18/07/2016 15:54
 * Copyright etech consulting 2016
 */

namespace App\Model;

use App\Database\PdoDatabase;
use App\Helpers\Debugger;

class MissionModel extends Model
{

    public function __construct()
    {
        parent::__construct();
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

    public function getFournisseurs($idmission = array())
    {
        try {
            $sql = 'SELECT *
                FROM tab_bal_aux
                LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id';
            if (is_array($idmission) && !empty($idmission)) {
                $sql .= ' WHERE MISSION_ID IN (' . implode(',', $idmission) . ')';
            } else {
                $sql .= ' WHERE MISSION_ID = ' . $idmission;
            }
            return $this->database->query($sql);
        } catch (\Exception $e) {
        }
    }

}