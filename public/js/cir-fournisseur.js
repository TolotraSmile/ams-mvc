// Circularisation
(function (document,window) {
    var save = document.querySelector('#frns-save');
    var selected = [];
    save.addEventListener('click',function () {
        selected = [];

        var formData = new FormData();
        var $inputs = document.querySelectorAll('input[type="checkbox"]:checked');
        $inputs.forEach(function (element) {
            var row = element.parentNode.parentNode;
            //var $name = row.querySelectorAll('input[type="text"]')[0];
            //var $adresse = row.querySelectorAll('input[type="text"]')[1];
            //console.log($name.value);
//                {
//                    id: row.getAttribute('id'),
//                        name: $name.value,
//                    adresse: $adresse.value
//                }
            selected.push(row.getAttribute('id'));
        });

        console.log(selected);
        formData.append('data',JSON.stringify(selected));

        //console.log(window.getUrl('circularisation','circulariser'));

        var request = window.getHttpRequest();
        request.open('POST',window.getUrl('circularisation','circulariser'));
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                console.log(request.status);
                if (request.status == 200 || request.status == 0) {
                    console.log(request.responseText);
                }
            }
        }

    });

    window.generateCircularisation = function (context) {
        var node = context.parentNode.parentNode;
        var inputs = node.querySelectorAll('input[type="text"]');
        if (inputs) {
            var $name = inputs[0].value;
            var $adresse = inputs[1].value;
            if ($name != '' && $adresse != '') {
                node.querySelector('img').style.display = 'block';
                console.log($name,$adresse);
            }
            else {
                window.alert('Vous devriez remplir tous les champs');
            }
        }
    }

    window.openFile = function (context) {
        console.log(context.getAttribute('src'));
    }

})(document,window);