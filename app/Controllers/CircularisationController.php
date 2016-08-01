<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:12
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\Helpers\FormHelper;
use App\Model\CircularisationModel;
use App\Model\MissionModel;

class CircularisationController extends Controller
{
    /**
     * CircularisationController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->models = array(
            'mission' => new MissionModel(),
            'circularisation' => new CircularisationModel()
        );
    }

    /**
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @param $idMission
     * @return string
     */
    public function index($idMission = 53)
    {
        $results = $this->models['circularisation']->getCircularisation($idMission);
        $headers = array('', 'Compte', 'Code Tiers', 'Annexe', 'Solde');

        $table = '';
        foreach ($results as $result) {
            $checked = '';
            if ($result->bal_aux_id !== null) {
                $checked = 'checked';
            }
            $rows = FormHelper::surround('<input type="checkbox" value="" style="margin: 0 ;"' . $checked . ' >', 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_COMPTE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_CODE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_LIBELLE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_SOLDE, 'td');
            $table .= FormHelper::surround($rows, 'tr', array('id' => $result->BAL_AUX_ID));
        }

        $table = FormHelper::surround($table, 'tbody');

        return FormHelper::surround(FormHelper::getTableHeader($headers) . $table, 'table');
    }

    public function circulariser($idMission = 53, $selected = array())
    {
        $results = $this->models['circularisation']->getCircularised($idMission, $selected);
        $headers = array('Compte', 'Code Tiers', 'Annexe', 'Solde', 'Nom', 'Adresse', '', '');
        $table = '';
        foreach ($results as $result) {
            $rows = FormHelper::surround($result->BAL_AUX_COMPTE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_CODE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_LIBELLE, 'td');
            $rows .= FormHelper::surround($result->BAL_AUX_SOLDE, 'td');
            $rows .= FormHelper::surround('<input type="text" value="' . $result->fileDestName . '" style="margin: 0 ;">', 'td');
            $rows .= FormHelper::surround('<input type="text" value="' . $result->fileDestCoord . '" style="margin: 0 ;">', 'td');
            $rows .= FormHelper::surround('<input type="button" value="Génerer" style="margin: 0;" onclick="generateCircularisation(this)">', 'td');
            $filename = '#';
            $display = 'none';
            if ($result->fileName !== null && file_exists($_SERVER['DOCUMENT_ROOT'] . $result->fileName)) {
                $filename = $result->fileName;
                $display = 'block';
            }
            $rows .= FormHelper::surround('<a href="' . $filename . '"><img src="../img/thumbs-word.png" style="width: 32px; height: 32px; display: ' . $display . ';" onclick="openFile(this)"/></a>', 'td');
            $table .= FormHelper::surround($rows, 'tr', array('id' => $result->BAL_AUX_ID));
        }

        $table = FormHelper::surround($table, 'tbody');

        return FormHelper::surround(FormHelper::getTableHeader($headers) . $table, 'table');
    }


}