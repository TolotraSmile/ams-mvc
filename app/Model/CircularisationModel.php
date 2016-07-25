<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:32
 * Copyright etech consulting 2016
 */

namespace App\Model;

use App\Database\PdoDatabase;
use App\Helpers\Debugger;

class CircularisationModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idMission
     * @return array|bool
     */
    public function getCircularisation($idMission)
    {
        $sql = 'SELECT *
                FROM tab_bal_aux
                LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id';
        if (empty($idMission) || $idMission == '') {
            return $this->database->query($sql);
        }
        if (!empty($idMission)) {
            $sql .= " WHERE BAL_AUX_COMPTE like '40%' AND  MISSION_ID " . $this->normalize($idMission);
        }
        return $this->database->query($sql);
    }

    public function getBalanceAux($idMission = [])
    {
        $sql = "SELECT tab_bal_aux.BAL_AUX_ID,BAL_AUX_CODE,BAL_AUX_COMPTE,BAL_AUX_LIBELLE,BAL_AUX_SOLDE
                FROM tab_bal_aux
                WHERE BAL_AUX_COMPTE LIKE '40%' AND MISSION_ID" . $this->normalize($idMission) . "ORDER BY BAL_AUX_COMPTE,BAL_AUX_CODE ASC";
        return $this->database->query($sql);
    }

}