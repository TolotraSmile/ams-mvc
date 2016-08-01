<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 09:23
 * Copyright etech consulting 2016
 */


require '../vendor/autoload.php';


if (isset($_GET['page']) && !empty($_GET['page'])) {

    $content = array();
    $config = require 'Config/mapping.php';

    $url = explode('@', $_GET['page']);

    if (!isset($url[1]) || empty($url[1])) {
        $url[1] = 'index';
    }

    $method = $url[1];

    if (isset($config['controllers'][$url[0]])) {
        $controller = new $config['controllers'][$url[0]]();
        $content = $controller->$method(json_decode($_POST['data']));
    }

    print json_encode($content);

} else {
    header('Not Found', true, 404);
}