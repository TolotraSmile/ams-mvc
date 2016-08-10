<?php
require '../../vendor/autoload.php';

$now = new DateTime();

$missionId = [53, $now->getTimestamp()];
$faker = Faker\Factory::create();

$dateLimite = new DateTime($faker->date());

$options = [
    'dateLimite' => ucwords(strftime("%d %B %Y", $dateLimite->getTimestamp())),
    'date' => ucwords(strftime("%d %B %Y", $now->getTimestamp())),
    'nom' => $faker->name,
    'coordonnees' => $faker->address
];

echo \App\Reporting\WordReporting::render('template_lettre_fournisseur', $missionId, $options);