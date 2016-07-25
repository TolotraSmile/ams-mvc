<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/skeleton.css">
    <link rel="stylesheet" href="public/css/main.css">
    <title>AMS</title>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
defined('ROOT') || define('ROOT', __DIR__);

require 'vendor/autoload.php';

if (isset($_GET['page']) && !empty($_GET['page'])) {

    $content = [];
    $config = require 'app/Config/mapping.php';

    $url = explode('@', $_GET['page']);
    $method = $url[1];

    if (isset($config['controllers'][$url[0]])) {
        $controller = new $config['controllers'][$url[0]]();
        $content = $controller->$method(json_decode($_POST['data']));
    }

    //print json_encode([$controller, $content, json_decode($_POST['data'])]);

} else {
    require_once 'public/pages/index.php';
    //header('Not Found', true, 404);
}


?>
</body>

<script type="application/javascript" src="public/js/ajax.js"></script>
<script type="application/javascript" src="public/js/cir-fournisseur.js"></script>
<script>

</script>

</html>