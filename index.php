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
    <div class="box-subtitle">
        Sélectionner fournisseurs à circulariser
    </div>
</div>
<div class="section">
    <div class="box-container">
        <div class="box-row">
            <?php
            $controller = new \App\Controllers\CircularisationController();
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

<script type="application/javascript" src="public/js/ajax.js"></script>
<script>
    // Circularisation
    (function (document) {
        var
            save = document.querySelector('#frns-save');
        var
            selected = [];
        save.addEventListener('click',function () {
            selected = [];

            var
                formData = new FormData();
            var
                $inputs = document.querySelectorAll('input[type="checkbox"]:checked');
            $inputs.forEach(function (element) {
                var row = element.parentNode.parentNode;
                selected.push(row.getAttribute('id'));
            });
            formData.append('frns-ids',selected);

            var request = window.getHttpRequest();
            request.open('POST',window.getUrl('circularisation','circulariser'));
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    console.log(request.status);
                    if (request.status == 200 || request.status == 0) {
                        console.log(request.responseText);
                    }
                }
            }
        });
    })(document);
</script>

</html>