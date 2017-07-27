/**
 * Created by david on 2017/5/13.
 */
function submitDeleteQuestion() {
    var id = document.getElementById('toBeDeletedID').innerText.slice(16);
    // alert(id);

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            if (!alert(result)) {
                window.location.reload(true);
            }
        }
    };

    xmlHttp.open("GET", "php/deleteQuestion.php?q=" + id, true);
    xmlHttp.send();
}