<?php if (isset($_SESSION['idMission']) && isset($_SESSION['id']) && isset($_GET['type']) && isset($index)): ?>
    <form class="circularisation-content" method="post" action="public/pages/frns_circularisation.php">
        <div class="section">
            <div class="box-title">Sélectionner <?= $_GET['type'] ?> à circulariser</div>
        </div>
        <?php $controller = new \App\Controllers\CircularisationController($index);
        $data = $controller->index($_SESSION['idMission']); ?>
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
                <h4>Aucun <b><?= strtoupper($_GET['type']) ?></b> à circulariser.</h4>
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
    <div class="footer">
        <span class="item">Revue Analytique</span>
        <span class="separator"> &gt; </span>
        <span class="item mission"><?= $controller->getMissionName($_SESSION['idMission']); ?></span>
        <span class="separator"> &gt; </span>
        <span class="item">Circularisation <?= $_GET['type'] ?></span>
    </div>

    <script type="application/javascript" src="public/js/ajax.js"></script>
    <script type="application/javascript">
        // Circularisation
        (function (document,window) {
            var $save = document.querySelector('#frns-save')
            if ($save) {
                $save.addEventListener('click',function () {
                    var selected = [];

                    var $inputs = document.querySelectorAll('input[type="checkbox"]:checked');

                    for (var i = 0,length = $inputs.length; i < length; i++) {
                        var row = $inputs[i].parentNode.parentNode;
                        selected.push(row.getAttribute('id'));
                    }

                    if (selected.length > 0) {
                        var url = 'public/pages/circularisation.php?circularisation=fournisseur&type=<?php echo $_GET["type"]?>&data='
                            + encodeURIComponent(JSON.stringify(selected));
                        console.log(url);
                        window.location.href = url;
                    } else {
                        alert('Vous devriez sélectionner au moins un element à circulariser');
                    }
                });
            }

            document.querySelector('#frns-back').addEventListener('click',function () {
                console.log(window.history);
                if (window.history) {
                    window.history.back();
                }
            });
        })(document,window);
    </script>
<?php else: ?>
    <div class="box">
        <h4>Veuillez sélectionner une mission.</h4>
    </div>
<?php endif; ?>