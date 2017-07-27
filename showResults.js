/**
 * Created by david on 2017/5/9.
 */
function showResults(value) {
    if (value.length === 0) {
        document.getElementById('updateLiveSearch').innerHTML = '';
        return;
    }

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('updateLiveSearch').innerHTML = this.responseText;
        }
    }

    xmlHttp.open("GET", "liveSearch.php?q=" + value, true);
    xmlHttp.send();
}