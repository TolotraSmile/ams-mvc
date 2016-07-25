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
            echo $controller->index($_GET['idMission']);
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
