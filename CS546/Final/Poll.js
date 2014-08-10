var xmlhttp = new XMLHttpRequest();
var flag = true;
function poll() {
    "use strict";
    xmlhttp.open("POST", "./Poll.php", true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText.indexOf("nope") !== -1) {
                if (flag) {
                    window.alert("The document you are reading is being edited by another user at this time and its current state may not reflect changes that user makes.");
                    flag = false;
                }
            }
        }
    };
}
poll();
setInterval(poll, 5000);