/**
 * Created by tmsc on 21/07/2016.
 */


(function (window) {
    window.getHttpRequest = function () {
        var httpRequest = false;

        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
            }
        }
        else if (window.ActiveXObject) { // IE
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {
                    console.log(e);
                }
            }
        }

        if (!httpRequest) {
            console.log('Impossible to create XMLHttp object.');
            return false;
        }

        return httpRequest
    }

    window.getUrl = function (controller,callable) {
        return 'app/router.php?page=' + encodeURIComponent(controller + '@' + callable);
    }
})(window);
