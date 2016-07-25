<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
defined('ROOT') || define('ROOT', __DIR__);

require 'vendor/autoload.php';
ob_start();

if (isset($_GET['page']) && !empty($_GET['page'])) {

    $content = [];
    $config = require 'app/Config/mapping.php';

    $url = explode('@', $_GET['page']);

    if (!isset($url[1]) || empty($url[1])) {
        $url[1] = 'index';
    }

    $method = $url[1];

    if (isset($config['controllers'][$url[0]])) {
        $controller = new $config['controllers'][$url[0]]();
        $content = $controller->$method();
    }

    //print json_encode([$controller, $content, json_decode($_POST['data'])]);

} else {
    $controller = new \App\Controllers\CircularisationController();
    $content = $controller->index($_GET['idMission']);
    require_once 'public/pages/index.php';
    $content = ob_get_clean();
}

require_once 'public/pages/templates/default.php';