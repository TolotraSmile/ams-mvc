<?php if (isset($_SESSION['idMission']) && isset($_SESSION['id']) && isset($_GET['type'])): ?>
    <form class="circularisation-content" method="post" action="public/pages/frns_circularisation.php">
        <div class="section">
            <div class="box-title">
                <?= strtoupper($_GET['type'] . 's') ?> : Comptes 40
            </div>
            <div class="box-subtitle">
                Sélectionner fournisseurs à circulariser
            </div>
        </div>
        <?php $controller = new \App\Controllers\CircularisationController(40);
        $data = $controller->index($_SESSION['idMission']);
        ?>
        <?php if ($data): ?>

            <div class="section">
                <div class="box-container">
                    <div class="box-row">
                        <?= $data ?>
                    </div>
                </div>
            </div>
            <footer>
                <div class="box">
                    <div class="box-content">
                        <input id="frns-back" class="button button-back" type="button" value="Retour">
                        <input id="frns-save" class="button button-primary control" type="button" value="Circulariser">
                    </div>
                </div>
            </footer>
        <?php else: ?>
            <div class="box">
                <h4>Aucun fournisseur à circulariser.</h4>
            </div>
            <footer>
                <div class="box">
                    <div class="box-content">
                        <input id="frns-back" class="button button-back" type="button" value="Retour">
                    </div>
                </div>
            </footer>
        <?php endif; ?>
    </form>

    <script type="application/javascript" src="public/js/ajax.js"></script>
    <script type="application/javascript">
        // Circularisation
        (function (document, window) {
            var $save = document.querySelector('#frns-save')
            if ($save) {
                $save.addEventListener('click', function () {
                    var selected = [];

                    var $inputs = document.querySelectorAll('input[type="checkbox"]:checked');
                    $inputs.forEach(function (element) {
                        var row = element.parentNode.parentNode;
                        selected.push(row.getAttribute('id'));
                    });

                    if (selected.length > 0) {

                        var url = 'public/pages/circularisation.php?circularisation=fournisseur&type=<?php echo $_GET["type"]?>&data='
                            + encodeURIComponent(JSON.stringify(selected));
                        console.log(url);

                        window.location.href = url;
                    }
                    else {
                        alert('Vous devriez sélectionner au moins un element à circulariser');
                    }
                });
            }

            document.querySelector('#frns-back').addEventListener('click', function () {
                console.log(window.history);
                if (window.history) {
                    window.history.back();
                }
            });
        })(document, window);
    </script>
<?php else: ?>
    <div class="box">
        <h4>Veuillez sélectionner une mission.</h4>
    </div>
<?php endif; ?>
