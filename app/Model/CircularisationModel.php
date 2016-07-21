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

class CircularisationModel
{
    private $database;

    public function __construct(PdoDatabase $database)
    {
        $this->database = $database;
    }

    /**
     * @param $idmission
     * @return array|bool
     */
    public function getFournisseurs($idmission)
    {
        $sql = 'SELECT *
                FROM tab_bal_aux
                LEFT JOIN tab_circularisation_fichier
                ON tab_bal_aux.BAL_AUX_ID = tab_circularisation_fichier.bal_aux_id';
        if (empty($idmission) || $idmission == '') {
            return $this->database->query($sql);
        }
        if (is_array($idmission) && !empty($idmission)) {
            $sql .= ' WHERE MISSION_ID IN (' . implode(',', $idmission) . ')';
        } else {
            $sql .= " WHERE BAL_AUX_COMPTE like '40%' AND MISSION_ID = $idmission";
        }
        return $this->database->query($sql);
    }

    /**
     * @param array $mission
     * @return array
     */
    public function getFournisseursInputs($mission = [])
    {
        $fournisseurs = $this->getFournisseurs($mission);
        $data = [];
        foreach ($fournisseurs as $value) {
            $value->input = '<input type="checkbox" value="" style="margin: 0 0 0 20px;">';
            $data[] = $value;
        }
        return $data;
    }

    public function getCircularisation($balAuxId = [])
    {
        $fournisseurs = $this->getFournisseurs($balAuxId);
        return $fournisseurs;
    }

}