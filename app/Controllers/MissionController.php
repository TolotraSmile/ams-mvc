<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 15:14
 * Copyright etech consulting 2016
 */

namespace App\Controllers;

use App\Helpers\TableHelper;
use App\Model\CircularisationModel;
use App\Model\MissionModel;

class MissionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->models = array(
            'mission' => new MissionModel(),
            'circularisation' => new CircularisationModel()
        );
    }

    public function index()
    {
        $missions = $this->models['mission']->getMissions();
        $table = new TableHelper($missions, array('Mission' => 'MISSION_ID'), 'ID');
        echo $table->getTable();
    }

    public function fournisseurs($missions)
    {
        $result = $this->models['circularisation']->getFournisseursInputs($missions);
        $keys = array('' => 'input', 'Compte' => 'BAL_AUX_COMPTE', 'Code Tiers' => 'BAL_AUX_CODE', 'Annexe' => 'BAL_AUX_LIBELLE', 'Solde' => 'BAL_AUX_SOLDE');
        $table = new TableHelper($result, $keys, '', array('style' => 'margin-bottom: 100px;'), 'BAL_AUX_ID');
        echo $table->getTable();
    }

    public function circularisation($missions)
    {
        $result = $this->models['circularisation']->getCircularisation($missions);
        $keys = array(
            '' => 'input',
            'Compte' => 'BAL_AUX_COMPTE',
            'Code Tiers' => 'BAL_AUX_CODE',
            'Annexe' => 'BAL_AUX_LIBELLE',
            'Solde' => 'BAL_AUX_SOLDE',
            'Nom' => 'nom',
            'Coordonnées' => 'coordonnee',
            'Génerer' => 'button'
        );
        $table = new TableHelper($result, $keys, '', array('style' => 'margin-bottom: 100px;'), 'BAL_AUX_ID');
        echo $table->getTable();

    }
}