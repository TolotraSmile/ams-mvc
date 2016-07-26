<?php use App\Helpers\Debugger;

require '../../vendor/autoload.php'; ?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>AMS</title>
</head>
<body>
<form class="circularisation-content" action="../../index.php?">
    <div class="section">
        <div class="box-title">
            FOURNISSEURS : Comptes 40
        </div>
        <div class="box-subtitle">
            Circularisation des fournisseurs
        </div>
    </div>
    <div class="section">
        <div class="box-container">
            <div class="box-row">
                <?php $controller = new \App\Controllers\CircularisationController();
                echo $controller->circularisation($_SESSION['idMission'], json_decode($_GET['data'])); ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="box">
            <div class="box-content">
                <input id="frns-list" class="button button-primary control" type="button" value="Voir la liste">
            </div>
        </div>
    </footer>
</form>

<script type="application/javascript" src="../js/ajax.js"></script>
<script type="application/javascript">
    // Circularisation
    (function (document,window) {
        document.querySelector('#frns-list').addEventListener('click',function () {
            window.history.back();
        });

        window.generateCircularisation = function (context) {
            var node = context.parentNode.parentNode;
            var inputs = node.querySelectorAll('input[type="text"]');
            if (inputs) {
                var $name = inputs[0].value;
                var $adresse = inputs[1].value;
                if ($name != '' && $adresse != '') {
                    node.querySelector('img').style.display = 'block';
                    console.log($name,$adresse);
                }
                else {
                    window.alert('Vous devriez remplir tous les champs');
                }
            }
        }
        window.openFile = function (context) {
            console.log(context.getAttribute('src'));
        }

    })(document,window);
</script>
</body>
</html>