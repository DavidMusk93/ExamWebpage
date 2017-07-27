/**
 * Created by david on 2017/5/9.
 */
function hideOption(id) {
    /*always wrong
     if (document.getElementById("select1-A").innerText.trim().length == 1) {
     document.getElementById("select1-A").style.display = "none";
     }*/
    // console.log(id);
    var x = document.getElementById(id);
    x.style.display = x.innerText.trim().length > 1? "block" : "none";
}