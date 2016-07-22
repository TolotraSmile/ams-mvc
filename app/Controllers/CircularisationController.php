<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:12
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\Helpers\DataTableHelper;
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
        $result = $this->models['circularisation']->getFournisseurs($missions);
        $headers = ['Compte', 'Code Tiers', 'Annexe', 'Solde', 'Nom', 'Adresse', '', ''];

        $keys = [
            1 => 'BAL_AUX_COMPTE',
            2 => 'BAL_AUX_CODE',
            3 => 'BAL_AUX_LIBELLE',
            4 => 'BAL_AUX_SOLDE',
            5 => '<input type="text" value="" style="margin: 0 ;">',
            6 => '<input type="text" value="" style="margin: 0 ;">',
            7 => '<input type="button" value="Génerer" style="margin: 0;" onclick="generate(this)">',
            8 => '<img src="public/img/word-icon.png" style="width: 32px; height: 32px;" onclick="openFile(this)"/>'
        ];

        $table = new DataTableHelper($result, $keys, $headers, ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        echo $table->getTable();
    }

    public function circularisation($missions)
    {
        $result = $this->models['circularisation']->getCircularisation($missions);
        $keys = ['' => 'input', 'Compte' => 'BAL_AUX_COMPTE', 'Code Tiers' => 'BAL_AUX_CODE', 'Annexe' => 'BAL_AUX_LIBELLE', 'Solde' => 'BAL_AUX_SOLDE'];
        $table = new TableHelper($result, $keys, '', ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        echo $table->getTable();
    }

    public function circulariser($aux)
    {
        //$result = $this->models['circularisation']->getCircularisation($aux);
        $ids = implode(', data', $aux);
        return $ids;
    }

}