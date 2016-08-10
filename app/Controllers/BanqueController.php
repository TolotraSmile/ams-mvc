<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 10/08/2016 10:32
 * Copyright etech consulting 2016
 */

namespace App\Controllers;


use App\Helpers\Debugger;
use App\Helpers\FormHelper;
use App\Model\BanqueModel;

class BanqueController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new BanqueModel();
    }

    public function index()
    {
        $data = $this->model->getDatas($_SESSION['idMission']);
        if ($data) {
            $headers = array('', 'Compte', 'Intitulé', 'Solde');
            $table = '';
            foreach ($data as $result) {

                $rows = FormHelper::surround('<input type="checkbox" value="" style="margin: 0;"', 'td');
                $rows .= FormHelper::surround($result->IMPORT_COMPTES, 'td');
                $rows .= FormHelper::surround($result->IMPORT_INTITULES, 'td');
                $rows .= FormHelper::surround($result->IMPORT_SOLDE, 'td');
                $table .= FormHelper::surround($rows, 'tr', array('id' => $result->IMPORT_ID));
            }

            $table = FormHelper::surround($table, 'tbody');

            return FormHelper::surround(FormHelper::getTableHeader($headers) . $table, 'table');
        }
        return false;
    }

    public function circularisation()
    {
        $data = $this->model->getCircularised($_SESSION['idMission'], json_decode($_GET['data']));

        if ($data) {
            $headers = array('', 'Compte', 'Intitulé', 'Solde', 'Nom de la banque', '	Coordonnées');
            $table = '';

            $counter = 1;

            foreach ($data as $result) {

                $rows = FormHelper::surround($counter++, 'td');
                $rows .= FormHelper::surround($result->IMPORT_COMPTES, 'td');
                $rows .= FormHelper::surround($result->IMPORT_INTITULES, 'td');
                $rows .= FormHelper::surround($result->IMPORT_SOLDE, 'td');
                $rows .= FormHelper::surround('<input type="text" value="" style="margin: 0 ;">', 'td');
                $rows .= FormHelper::surround('<input type="text" value="" style="margin: 0 ;">', 'td');
                $rows .= FormHelper::surround('<input type="button" value="Génerer" style="margin: 0;" onclick="generateCircularisation(this, 0)">', 'td');

                $table .= FormHelper::surround($rows, 'tr', array('id' => $result->IMPORT_ID));
            }

            $table = FormHelper::surround($table, 'tbody');

            return FormHelper::surround(FormHelper::getTableHeader($headers) . $table, 'table');
        }
        return false;
    }
}