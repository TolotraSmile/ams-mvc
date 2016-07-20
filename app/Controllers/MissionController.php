<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 19/07/2016 15:14
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\App;
use App\Helpers\TableHelper;
use App\Model\CircularisationModel;
use App\Model\MissionModel;

class MissionController extends Controller
{

    private $models = [];
    private $database;

    public function __construct()
    {
        $this->database = App::getInstance()->getPdo();
        $this->models['mission'] = new MissionModel($this->database);
        $this->models['circularisation'] = new CircularisationModel($this->database);
    }

    public function index()
    {
        $missions = $this->models['mission']->getMissions();
        $table = new TableHelper($missions, ['Mission' => 'MISSION_ID'], 'ID');
        echo $table->getTable();
    }

    public function fournisseurs($missions)
    {
        $result = $this->models['circularisation']->getCircularisation($missions);
        $keys = ['' => 'input', 'Compte' => 'BAL_AUX_COMPTE', 'Code Tiers' => 'BAL_AUX_CODE', 'Annexe' => 'BAL_AUX_LIBELLE', 'Solde' => 'BAL_AUX_SOLDE'];
        $table = new TableHelper($result, $keys, '', ['style' => 'margin-bottom: 120px;'], 'BAL_AUX_ID');
        echo $table->getTable();
    }
}