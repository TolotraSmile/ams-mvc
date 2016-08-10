<form class="circularisation-content" style="margin-bottom: 80px">
    <div class="section">
        <div class="box-title">
            Débiteurs et créditeurs divers
        </div>
    </div>
    <div class="section">
        <div class="box-container">
            <div class="box-row">
                <table>
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Coordonnées</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $controller = new \App\Controllers\CircularisationController(44); ?>
                    <?php foreach ($controller->getDcd($_SESSION['idMission']) as $item): ?>
                        <tr>
                            <td>
                                <input type="text" value="<?= $item->fileDestName ?>" style="margin: 0 ;" title="name">
                            </td>
                            <td>
                                <input type="text" value="<?= $item->fileDestCoord ?>" style="margin: 0 ;"
                                       title="infos">
                            </td>
                            <td>
                                <input type="button" value="Génerer" style="margin: 0;" onclick="generateAvocat(this)"/>
                            </td>
                            <td>
                                <?php $file = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $item->fileName) && $item->fileName != null; ?>
                                <a href="<?= $file ? $item->fileName : '#' ?>">
                                    <img src="public/img/thumbs-word.png"
                                         style="width: 32px; height: 32px; display: <?= $file ? 'block' : 'none' ?>"/>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
<script type="application/javascript" src="public/js/ajax.js"></script>
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
                var request = window.getHttpRequest();

                //console.log(request);

                var url = "public/pages/frns_generate.php?name=" + $name.value + "&adresse=" + $infos.value + "&idBalAux=0&type=44";
                console.log(url);

                request.open('post', url);
                request.addEventListener('readystatechange', function () {
                    if (request.readyState == 4) {
                        if (request.status == 200 || request.status == 0) {
                            try {
                                var img = $parent.querySelector('img');
                                img.style.display = 'block';

                                console.log(request.responseText);

                                var response = JSON.parse(request.responseText);
                                img.parentNode.setAttribute('href', response.result.toString());
                                alert('Le fichier a été bien  generé.');

                                window.location.reload();

                            } catch (e) {
                                alert('Le fichier n\'a pas pu être generé. ERROR:' + e)
                            }
                        }
                    }
                });
                request.send(null);

            }
            else {
                alert('Vous devriez remplir tous les champs. Merci!');
            }
        }
    })(window, document);
</script>