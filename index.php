<?php require 'vendor/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/skeleton.css">
    <title>AMS</title>
</head>
<body>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new \App\Model\MissionModel(\App\App::getInstance()->getPdo());
$missions = $db->getMissions();
$i = 0;
?>
<table class="u-full-width" style="margin: 20px;">
    <thead>
    <tr>-
        <th>ID</th>
        <th>Date d'exercice</th>
        <th>Type</th>
        <th>Année</th>
        <th>Nom</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($i < count($missions)) : ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $missions[$i]->MISSION_DATE_DEBUT . ' au ' . $missions[$i]->MISSION_DATE_CLOTURE ?></td>
            <td><?= $missions[$i]->MISSION_TYPE ?></td>
            <td><?= $missions[$i]->MISSION_ANNEE ?></td>
            <td><?= $missions[$i]->ENTREPRISE_DENOMINATION_SOCIAL . " - " . $missions[$i]->ENTREPRISE_RAISON_SOCIAL ?></td>
        </tr>
        <?php $i++; ?>
    <?php endwhile; ?>
</table>
</body>
</html>