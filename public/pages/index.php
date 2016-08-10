<?php require '../../vendor/autoload.php';

session_start();

$controller = new \App\Controllers\BanqueController();
echo $controller->circularisation();
