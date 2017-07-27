/**
 * Created by davidmusk on 6/9/2017.
 */
function setCookie(username, token, expireDuration) {
    var d = new Date();
    d.setTime(d.getTime() + (expireDuration * 60 * 60 * 1000));
    var expireTime = 'expires=' + d.toUTCString();

    // browser automatic alert expiring time
    document.cookie = "username=" + username + "; " + "; " + expireTime + "; path=/";
    document.cookie = "token=" + token;
    // console.log(document.cookie);  // could not see expire and path in browser
}