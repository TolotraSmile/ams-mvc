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

<?php require '../../vendor/autoload.php'; ?>

<?php $type = array('client' => 41, 'fournisseur' => 40); ?>

<?php if (isset($_GET['type']) && isset($type[$_GET['type']])): ?>
    <form class="circularisation-content" action="../../index.php?">
        <div class="section">
            <div class="box-title">
                <?= strtoupper($_GET['type']) . 'S : Comptes ' . $type[$_GET['type']] ?>
            </div>
            <div class="box-subtitle">
                Circularisation des <?= $_GET['type'] ?>s
            </div>
        </div>
        <div class="section">
            <div class="box-container">
                <div class="box-row">
                    <?php $controller = new \App\Controllers\CircularisationController($type[$_GET['type']]);
                    echo $controller->circulariser($_SESSION['idMission'], json_decode($_GET['data'])); ?>
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

            window.generateCircularisation = function (context,type) {
                // Get the current row <tr>
                var node = context.parentNode.parentNode;

                // Get the inner inputs
                var $inputs = node.querySelectorAll('input[type="text"]');
                var link = node.querySelector('a');

                // Save function
                var save = function (inputs) {
                    if (inputs) {
                        var $name = inputs[0].value;
                        var $adresse = inputs[1].value;
                        var $idBalAux = node.getAttribute('id') | 0;

                        if ($name != '' && $adresse != '') {
                            var request = window.getHttpRequest();
                            var url = 'frns_generate.php?name=' + $name + '&adresse=' + $adresse + '&idBalAux=' + $idBalAux + "&type=" + type;

                            console.log(url);

                            request.open('post',url);
                            request.addEventListener('readystatechange',function () {
                                if (request.readyState == 4) {
                                    if (request.status == 200 || request.status == 0) {
                                        var response = JSON.parse(request.responseText);
                                        try {
                                            var img = node.querySelector('img');
                                            img.style.display = 'block';
                                            img.parentNode.setAttribute('href',response.result.toString());
                                            alert('Le fichier a été bien  generé.');
                                        } catch (e) {
                                            alert('Le fichier n\'a pas pu être generé. ERROR:' + e)
                                        }
                                    }
                                }
                            });
                            request.send(null);
                        }
                        else {
                            window.alert('Vous devriez remplir tous les champs');
                        }
                    }
                }

                if (link && link.getAttribute('href') !== '#') {
                    if (confirm('Voulez-vous écraser le fichier?') === true) {
                        save($inputs);
                    }
                }
                else {
                    save($inputs)
                }
            }
            window.openFile = function (context) {
                console.log(context.getAttribute('src'));
            }
        })(document,window);
    </script>

<?php else: ?>
    <div class="box">
        <h1>Page introuvable</h1>
        <?php header('Not Found', true, 404) ?>
    </div>
<?php endif; ?>

</body>
</html>