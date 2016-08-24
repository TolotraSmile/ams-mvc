<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 10:32
 * Copyright etech consulting 2016
 */

namespace App\Model;

use App\Helpers\Debugger;

class CircularisationModel extends Model
{

    protected $tableName = 'tab_circularisation_fichier';

    /**
     * CircularisationModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idMission
     * @param int|string $type
     * @return array|bool
     */
    public function getCircularisation($idMission, $type = 40)
    {
        $sql = 'SELECT * FROM tab_bal_aux LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id';
        if (empty($idMission) || $idMission == '') {
            return $this->database->query($sql);
        }

        if (!empty($idMission)) {
            $sql .= " WHERE BAL_AUX_COMPTE like '$type%' AND  MISSION_ID " . $this->normalize($idMission);
        }

        return $this->database->query($sql);
    }

    /**
     * @param int $idBalAux
     * @param array $where
     * @param array $filter
     * @return bool
     */
    public function exists($idBalAux = 0, $where = array(), $filter = array())
    {
        $sql = "SELECT bal_aux_id as rows FROM tab_circularisation_fichier WHERE bal_aux_id = $idBalAux";

        if (!empty($where)) {
            $sql .= " AND " . implode(' AND ', $where);
        }

        if (!empty($filter)) {
            $sql .= " AND " . $this->normalize($filter);
        }

        $result = $this->database->query($sql, true);

        return ($result && $result->rows > 0) ? $result->rows : false;
    }

    public function existByName($type, $name)
    {
        $sql = "SELECT idFile
                FROM tab_circularisation_fichier 
                WHERE fileCategory LIKE '%$type%' AND fileDestName LIKE '%$name%'";
        $result = $this->database->query($sql, true);

        return ($result && $result->idFile !== '') ? $result->idFile : 0;
    }


    /**
     * @param $idMission
     * @param array $ids
     * @param int $type
     * @return array|bool|\PDOStatement
     */
    public function getCircularised($idMission, $ids = array(), $type = 40)
    {
        $sql = "SELECT * FROM tab_bal_aux LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id
                WHERE BAL_AUX_COMPTE LIKE '$type%' ";
        if (!empty($ids) && $ids != '') {
            $sql .= " AND tab_bal_aux.BAL_AUX_ID " . $this->normalize($ids);
        }
        $sql .= " AND MISSION_ID" . $this->normalize($idMission) . "ORDER BY BAL_AUX_COMPTE,BAL_AUX_CODE ASC";

        return $this->database->query($sql);
    }

    /**
     * @param string $type
     * @param int $idMission
     * @return array|bool|\PDOStatement
     */
    public function getDatasCircularisation($type = 'fournisseur', $idMission = 0)
    {
        $sql = "SELECT * FROM tab_circularisation_fichier LEFT JOIN tab_bal_aux 
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id 
                WHERE fileCategory='$type' AND fileIdMission" . $this->normalize($idMission) . "ORDER BY BAL_AUX_COMPTE,BAL_AUX_CODE ASC";
        return $this->database->query($sql);
    }

    public function getDateLimite($idMission)
    {
        $sql = "SELECT MISSION_DATE_CLOTURE FROM tab_mission WHERE MISSION_ID=$idMission";
        return $this->database->query($sql, true)->MISSION_DATE_CLOTURE;
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