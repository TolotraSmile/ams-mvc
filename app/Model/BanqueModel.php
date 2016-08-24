<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 10/08/2016 10:33
 * Copyright etech consulting 2016
 */

namespace App\Model;

class BanqueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'tab_importer';
    }

    public function getDatas($idMission, $filter = array())
    {
        $sql = "SELECT IMPORT_ID,IMPORT_COMPTES,IMPORT_INTITULES,IMPORT_SOLDE 
                FROM " . $this->tableName . " WHERE IMPORT_COMPTES LIKE '51%' AND MISSION_ID" . $this->normalize($idMission);
        if (!empty($filter)) {
            $sql .= " AND IMPORT_ID " . $this->normalize($filter);
        }
        return $this->database->query($sql);
    }

    public function getCircularised($idMission, $filter = array())
    {
        $sql = "SELECT *
                FROM " . $this->tableName . " 
                LEFT JOIN tab_circularisation_fichier
                ON tab_circularisation_fichier.banque_id=IMPORT_ID
                WHERE IMPORT_COMPTES LIKE '51%' AND MISSION_ID" . $this->normalize($idMission);

        if (!empty($filter)) {
            $sql .= " AND IMPORT_ID " . $this->normalize($filter);
        }

        return $this->database->query($sql);
    }

    public function getMission($idMission)
    {
        $sql = "SELECT tab_entreprise.* FROM tab_mission
                INNER JOIN tab_entreprise
                ON tab_mission.ENTREPRISE_ID=tab_entreprise.ENTREPRISE_ID
                WHERE tab_mission.MISSION_ID=$idMission";
        return $this->database->query($sql, true);
    }
}