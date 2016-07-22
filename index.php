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
            <?php $controller = new \App\Controllers\CircularisationController();
            $controller->index(53); ?>
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
    (function (document,window) {
        var save = document.querySelector('#frns-save');
        var selected = [];
        save.addEventListener('click',function () {
            selected = [];

            var formData = new FormData();
            var $inputs = document.querySelectorAll('input[type="checkbox"]:checked');
            $inputs.forEach(function (element) {
                var row = element.parentNode.parentNode;
                //var $name = row.querySelectorAll('input[type="text"]')[0];
                //var $adresse = row.querySelectorAll('input[type="text"]')[1];
                //console.log($name.value);
//                {
//                    id: row.getAttribute('id'),
//                        name: $name.value,
//                    adresse: $adresse.value
//                }
                selected.push(row.getAttribute('id'));
            });

            console.log(selected);
            formData.append('data',JSON.stringify(selected));

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

        window.generate = function (context) {
            var node = context.parentNode.parentNode;
            var inputs = node.querySelectorAll('input[type="text"]');
            if (inputs) {
                var $name = inputs[0].value;
                var $adresse = inputs[1].value;
                console.log($name,$adresse);
            }
        }

        window.openFile = function (context) {
            console.log(context.getAttribute('src'));
        }

    })(document,window);
</script>

</html>