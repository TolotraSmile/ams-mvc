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

    protected $tableName = 'tab_circularisation_fichier';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idMission
     * @param string $type
     * @return array|bool
     */
    public function getCircularisation($idMission, $type = 40)
    {
        $sql = 'SELECT *
                FROM tab_bal_aux
                LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id';
        if (empty($idMission) || $idMission == '') {
            return $this->database->query($sql);
        }

        if (!empty($idMission)) {
            $sql .= " WHERE BAL_AUX_COMPTE like '$type%' AND  MISSION_ID " . $this->normalize($idMission);
        }

        return $this->database->query($sql);
    }

    public function exists($idBalAux = 0)
    {
        $sql = "SELECT COUNT(bal_aux_id) as rows
                FROM tab_circularisation_fichier
                WHERE bal_aux_id = $idBalAux";
        $result = $this->database->query($sql);

        return $result && $result[0]->rows > 0;
    }

    /**
     * @param $idMission
     * @param array $ids
     * @param int|string $type
     * @return array|bool|\PDOStatement
     */
    public function getCircularised($idMission, $ids = array(), $type = 40)
    {
        $sql = "SELECT *
                FROM tab_bal_aux
                LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id
                WHERE BAL_AUX_COMPTE LIKE '$type%'";
        if (!empty($ids) && $ids != '') {
            $sql .= " AND tab_bal_aux.BAL_AUX_ID " . $this->normalize($ids);
        }
        $sql .= " AND MISSION_ID" . $this->normalize($idMission) . "ORDER BY BAL_AUX_COMPTE,BAL_AUX_CODE ASC";

        return $this->database->query($sql);
    }
}