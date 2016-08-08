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
                    <tr id="prototypeAvocat">
                        <td><input type="text" value="" style="margin: 0 ;" title="name"></td>
                        <td><input type="text" value="" style="margin: 0 ;" title="infos"></td>
                        <td><input type="button" value="Génerer" style="margin: 0;" onclick="generateAvocat(this)"/>
                        </td>
                        <td><a href="#"><img src="public/img/thumbs-word.png"
                                             style="width: 32px; height: 32px; display: none"/></a>
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
            </div>
        </div>
    </footer>
</form>
<div class="floating" onclick="cloneAvocat(this)">+</div>

<script type="application/javascript">
    (function (window, document) {

        window.cloneAvocat = function (element) {
            var $parent = document.querySelector('#prototypeAvocat');
            var $clone = $parent.cloneNode(true);
            $clone.setAttribute('id', '')

            var button = $parent.querySelector('td:last-child > input');
            if (button) {
                button.remove();
            }
            var elements = $clone.querySelectorAll('input[type="text"]');

            for (var i = 0, length = elements.length; i < length; i++) {
                elements[i].value = '';
            }

            $parent.parentNode.appendChild($clone);
            var img = $clone.querySelector('img');
            img.style.display = 'none';
        }

        window.generateAvocat = function (element) {
            var $parent = element.parentNode.parentNode;

            var $name = $parent.querySelector('input[title="name"]');
            var $infos = $parent.querySelector('input[title="infos"]');

            if ($name.value !== '' && $infos.value !== '') {
                var img = $parent.querySelector('img');
                img.style.display = 'block';
                img.parentNode.setAttribute('href', "#index");
            }
            else{
                alert('Vous devriez remplir tous les champs. Merci!');
            }
        }
    })(window, document);
</script>