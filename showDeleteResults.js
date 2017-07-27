/**
 * Created by david on 2017/5/12.
 */
function showDeleteResults(value) {
    if (value.length === 0) {
        document.getElementById('deleteLiveSearch').innerHTML = '';
        return;
    }

    var xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('deleteLiveSearch').innerHTML = this.responseText;
        }
    }

    xmlHttp.open("GET", "liveDeleteSearch.php?q=" + value, true);
    xmlHttp.send();
}