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
                <?= strtoupper($_GET['type']) . 'S : Comptes 51' ?>
            </div>
            <div class="box-subtitle">
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
        }

    })(document,window);
</script>

</body>
</html>