<form class="circularisation-content" style="margin-bottom: 80px">
    <div class="section">
        <div class="box-title">
            AVOCATS : Comptes 42
        </div>
    </div>
    <div class="section">
        <div class="box-container">
            <div class="box-row">
                <table>
                    <thead>
                    <tr>
                        <th>Nom de l'avocat</th>
                        <th>Coordonnées</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" value="" style="margin: 0 ;"></td>
                        <td><input type="text" value="" style="margin: 0 ;"></td>
                        <td><input type="button" value="Génerer" style="margin: 0;" onclick="generateAvocat(this)"/>
                        </td>
                        <td>
                            <a href="">
                                <img src="public/img/thumbs-word.png"
                                     style="width: 32px; height: 32px; display: none"/>
                            </a>
                        </td>
                        <td><input type="button" id="cloneAocat" value="+" style="margin: 0;"
                                   class="button button-primary control"
                                   onclick="cloneAvocat(this)"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
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

<script type="application/javascript">
    (function (window) {

        window.cloneAvocat = function (element) {
            var $parent = element.parentNode.parentNode;
            var $clone = $parent.cloneNode(true);

            $parent.querySelectorAll('td:last-child')[0].querySelector('input').remove();
            $clone.querySelectorAll('input[type="text"]').forEach(function (element) {
                element.value = '';
            });

            $parent.parentNode.appendChild($clone);
            var img = $clone.querySelector('img');
            img.style.display = 'none';
        }

        window.generateAvocat = function (element) {
            var $parent = element.parentNode.parentNode;

            var img = $parent.querySelector('img');
            img.style.display = 'block';
            img.parentNode.setAttribute('href',(Math.random() * 255) + '');

        }

    })(window);
</script>