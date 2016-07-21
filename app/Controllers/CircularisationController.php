<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:12
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\Helpers\TableHelper;
use App\Model\CircularisationModel;
use App\Model\MissionModel;

class CircularisationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->models = [
            'mission' => new MissionModel($this->database),
            'circularisation' => new CircularisationModel($this->database)
        ];
    }

    public function getModels()
    {
        return $this->models;
    }

    public function fournisseurs($missions)
    {
        $result = $this->models['circularisation']->getFournisseursInputs($missions);
        $keys = ['Compte' => 'BAL_AUX_COMPTE', 'Code Tiers' => 'BAL_AUX_CODE', 'Annexe' => 'BAL_AUX_LIBELLE', 'Solde' => 'BAL_AUX_SOLDE'];

        $extras = [
            0 => '<input type="checkbox" value="" style="margin: 0 0 0 20px;">',
            5 => '<input type="text" value="" style="margin: 0 ;">',
            6 => '<input type="text" value="" style="margin: 0 ;">',
            7 => '<input type="text" value="" style="margin: 0 ;">'
        ];

        $table = new TableHelper($result, $keys, '', ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID', $extras);
        echo $table->getTable();
    }

    public function circularisation($missions)
    {
        $result = $this->models['circularisation']->getCircularisation($missions);
        $keys = ['' => 'input', 'Compte' => 'BAL_AUX_COMPTE', 'Code Tiers' => 'BAL_AUX_CODE', 'Annexe' => 'BAL_AUX_LIBELLE', 'Solde' => 'BAL_AUX_SOLDE'];
        $table = new TableHelper($result, $keys, '', ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        echo $table->getTable();
    }

}