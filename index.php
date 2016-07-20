<!--Display all PHP Errors when Debug-->
<?php error_reporting(E_ALL);
ini_set('display_errors', 1); ?>

<!--Load the autoload file-->
<?php require 'vendor/autoload.php'; ?>

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
<div class="section">
    <div class="box-title">
        FOURNISSEURS : Comptes 40
    </div>
    <div class="box-subtitle">Sélectionner fournisseurs à circulariser
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <?php
            $controller = new \App\Controllers\MissionController();
            $controller->fournisseurs(53);
            ?>
        </div>
    </div>
</div>

<footer>
    <div class="box">
        <div class="box-content">
            <input id="frns-back" class="button control button-back" type="button" value="Retour">
            <input id="frns-save" class="button button-primary control" type="button" value="Circulariser">
        </div>
    </div>
</footer>

</body>

<script>
    // Circularisation
    (function (dom) {
        var save = dom.querySelector('#frns-save');
        var selected = [];
        save.addEventListener('click',function (e) {
            selected = [];
            var $inputs = dom.querySelectorAll('input[type="checkbox"]:checked');
            $inputs.forEach(function (element) {
                var row = element.parentNode.parentNode;
                selected.push(row.getAttribute('id'));
            });
            console.log(selected);
        });
    })(document);
</script>

</html>