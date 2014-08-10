var xmlhttp = new XMLHttpRequest();
function poll() {
    "use strict";
    xmlhttp.open("POST", "./Poll.php", true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText.indexOf("nope") !== -1) {
                window.alert("You cannot edit this document at this time because it is being edited by another user.");
                location.replace("./User.php");
            }
        }
    };
}
poll();
setInterval(poll, 5000);