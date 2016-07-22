<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 21/07/2016 09:23
 * Copyright etech consulting 2016
 */

require '../vendor/autoload.php';

if (isset($_GET['page']) && !empty($_GET['page'])) {

    $result = [];
    $config = require 'Config/mapping.php';

    $url = explode('@', $_GET['page']);
    $method = $url[1];

    if (isset($config['controllers'][$url[0]])) {
        $controller = new $config['controllers'][$url[0]]();
        $result = $controller->$method(json_decode($_POST['data']));
    } else {
        header('Access Denied', true, 500);
    }

    print json_encode([$controller, $result, json_decode($_POST['data'])]);

} else {
    header('Not Found', true, 404);
}
