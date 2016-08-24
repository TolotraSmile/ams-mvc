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

<?php if (isset($_GET['type'])): ?>
    <form class="circularisation-content" action="../../index.php?">
        <div class="section">
            <div class="box-title">
                Circularisation des <?= $_GET['type'] ?>s
            </div>
        </div>
        <div class="section">
            <div class="box-container">
                <div class="box-row">
                    <?php $controller = new \App\Controllers\BanqueController();
                    echo $controller->circularisation(); ?>
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

    <div class="footer">
        <span class="item">Revue Analytique</span>
        <span class="separator"> &gt; </span>
        <span class="item mission"><?= $controller->getMissionName($_SESSION['idMission']); ?></span>
        <span class="separator"> &gt; </span>
        <span class="item">Circularisation <?= $_GET['type'] ?></span>
    </div>

<?php else: ?>
    <div class="box">
        <h1>Page introuvable</h1>
        <?php header('Not Found', true, 404) ?>
    </div>
<?php endif; ?>

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
                        var url = 'frns_generate.php?name=' + $name + '&adresse=' + $adresse + '&idBalAux=' + $idBalAux + '&type=42';

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
                    } else {
                        window.alert('Vous devriez remplir tous les champs');
                    }
                }
            }

            if (link && link.getAttribute('href') !== '#') {
                if (confirm('Voulez-vous écraser le fichier?') === true) {
                    save($inputs);
                }
            } else {
                save($inputs)
            }
        }

    })(document,window);
</script>

</body>
</html>