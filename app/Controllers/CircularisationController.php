<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 11:12
 * Copyright etech consulting 2016
 */

namespace App\Controllers;

use App\Helpers\DataTableHelper;
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
        $this->models = [
            'mission' => new MissionModel(),
            'circularisation' => new CircularisationModel()
        ];
    }

    /**
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @param $missions
     * @return string
     */
    public function index($missions = 53)
    {
        $result = $this->models['circularisation']->getCircularisation($missions);
        $headers = ['', 'Compte', 'Code Tiers', 'Annexe', 'Solde'];

        $keys = [
            0 => '<input type="checkbox" value="" style="margin: 0 ;">',
            1 => 'BAL_AUX_COMPTE',
            2 => 'BAL_AUX_CODE',
            3 => 'BAL_AUX_LIBELLE',
            4 => 'BAL_AUX_SOLDE',
        ];

        $table = new DataTableHelper($result, $keys, $headers, ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        return $table->getTable();
    }

    /**
     * @param $missions
     * @return string
     */
    public function circularisation($missions)
    {
        $result = $this->models['circularisation']->getBalanceAux($missions);
        $headers = ['Compte', 'Code Tiers', 'Annexe', 'Solde', 'Nom', 'Adresse', '', ''];

        $keys = [
            1 => 'BAL_AUX_COMPTE',
            2 => 'BAL_AUX_CODE',
            3 => 'BAL_AUX_LIBELLE',
            4 => 'BAL_AUX_SOLDE',
            5 => '<input type="text" value="" style="margin: 0 ;">',
            6 => '<input type="text" value="" style="margin: 0 ;">',
            7 => '<input type="button" value="Génerer" style="margin: 0;" onclick="generateCircularisation(this)">',
            8 => '<img src="public/img/thumbs-word.png" style="width: 32px; height: 32px; display: none;" onclick="openFile(this)"/>',
        ];

        $table = new DataTableHelper($result, $keys, $headers, ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        return $table->getTable();
    }

    /**
     * @param $aux
     * @return string
     */
    public function circulariser($aux)
    {
        //$result = $this->models['circularisation']->getCircularisation($aux);
        $ids = implode(',', $aux);
        return $ids;
    }

}