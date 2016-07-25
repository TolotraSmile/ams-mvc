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
            <?= $content ?>
        </div>
    </div>
</div>

<footer>
    <div class="box">
        <div class="box-content">
            <a href="app/router.php">
                <input id="frns-back" type="button" value="Retour">
            </a>
            <input id="frns-save" class="button button-primary control" type="button" value="Circulariser">
        </div>
    </div>
</footer>

<script type="application/javascript" src="public/js/ajax.js"></script>
<script type="application/javascript" src="public/js/cir-fournisseur.js"></script>