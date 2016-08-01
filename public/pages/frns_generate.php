<?php

/*
 * Generate the word report for Circularisations
 * */

require '../../vendor/autoload.php';

use App\Helpers\Debugger;
use App\Reporting\WordReporting;

$result = array('result' => null, 'error' => true);
session_start();

if (isset($_GET['name']) && isset($_GET['adresse']) && isset($_GET['idBalAux'])) {

    $now = new DateTime();
    $name = array($_SESSION['idMission'], $_GET['idBalAux'], $now->getTimestamp());
    $faker = Faker\Factory::create();

    $dateLimite = new DateTime($faker->date());

    // TODO : Change the date info's to real data
    $options = array(
        'dateLimite' => ucwords(strftime("%d %B %Y", $dateLimite->getTimestamp())),
        'date' => ucwords(strftime("%d %B %Y", $now->getTimestamp())),
        'nom' => $_GET['name'],
        'coordonnees' => $_GET['adresse']
    );

    $result = WordReporting::render($name, $options, 'fournisseur');
}

if ($result && $result['error'] !== true) {

    // Insert data into database
    $data = array(
        'fileName' => $result['result'],
        'fileIdMission' => $_SESSION['idMission'],
        'fileDestName' => $_GET['name'],
        'fileDestCoord' => $_GET['adresse'],
        'fileCategory' => 'fournisseur',
        'fileTimeCreation' => $now->format('Y-m-d'),
        'bal_aux_id' => $_GET['idBalAux']
    );

    $model = new \App\Model\CircularisationModel();

    if ($model->exists($_GET['idBalAux'])) {
        $result['error'] = $model->update($data, 'bal_aux_id=' . $_GET['idBalAux']);
        $result['action'] = 'UPDATE';
    } else {
        $result['error'] = $model->insert($data);
        $result['action'] = 'INSERTION';
    }
    header($result['result'], false, 200);
} else {
    header('Error for generating file', false, 404);
}

Debugger::json($result);