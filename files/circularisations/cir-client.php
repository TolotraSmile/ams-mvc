<?php if (isset($_SESSION['idMission']) && isset($_SESSION['id']) && isset($_GET['type'])): ?>
    <form class="circularisation-content" method="post" action="public/pages/frns_circularisation.php">
        <div class="section">
            <div class="box-title">
                CLIENTS : Comptes 41
            </div>
            <div class="box-subtitle">
                Sélectionner clients à circulariser
            </div>
        </div>
        <div class="section">
            <div class="box-container">
                <div class="box-row">
                    <?php $controller = new \App\Controllers\CircularisationController(41);
                    echo $controller->index($_SESSION['idMission']); ?>
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
    </form>

    <script type="application/javascript" src="public/js/ajax.js"></script>
    <script type="application/javascript">
        (function (document,window) {
            document.querySelector('#frns-save').addEventListener('click',function () {
                var selected = [];
                var $inputs = document.querySelectorAll('input[type="checkbox"]:checked');

                $inputs.forEach(function (element) {
                    var row = element.parentNode.parentNode;
                    selected.push(row.getAttribute('id'));
                });

                if (selected.length > 0) {
                    window.location.href = 'public/pages/circularisation.php?circularisation=client&type=<?php echo $_GET["type"]; ?>&data='
                        + encodeURIComponent(JSON.stringify(selected));
                } else {
                    alert('Vous devriez sélectionner au moins un element à circulariser');
                }
            });
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
