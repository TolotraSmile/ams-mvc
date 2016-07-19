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

$table = new \App\Helpers\TableHelper($missions,
    [
        'ID' => 'ENTREPRISE_DENOMINATION_SOCIAL',
        'Date d\'exercice' => ['MISSION_DATE_DEBUT', 'MISSION_DATE_CLOTURE'],
        'Année' => 'MISSION_ANNEE'
    ]
);
echo $table->getTable();
$i = 0;
?>

<code>function</code>
</body>
</html>