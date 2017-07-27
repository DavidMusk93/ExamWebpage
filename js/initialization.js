/**
 * Created by davidmusk on 6/9/2017.
 */
var ip = {};

// get local IP address
function getLocalIP(json) {
    ip["local"] = json.ip;
}

// get public IP address
function getIP(json) {
    ip["public"] = json.ip;
}

// ip["router"] = "172.30.14.104";
ip["router"] = "10.170.12.1";  // for testing

var loginAvailable = function (routerIP, localIP) {
    routerIPArray = routerIP.split('.');
    localIPArray = localIP.split('.');

    for (var i = 0; i < 3; i++) {
        if (routerIPArray[i] !== localIPArray[i]) {
            return false;
        }
    }

    // the local ip 4-th number should vary from 100 to 199
    return (localIPArray[3] > 99 && localIPArray[3] < 255);
};

// refresh page checking
$(document).ready(function refreshCheck() {
    var username = document.cookie.replace(/(?:(?:^|.*;\s*)username\s*\=\s*([^;]*).*$)|^.*$/, '$1');
    var token = document.cookie.replace(/(?:(?:^|.*;\s*)token\s*\=\s*([^;]*).*$)|^.*$/, '$1');
    // console.log(token);

    // cookie is not none
    if (username && token) {
        var refreshInfo = {};
        refreshInfo['username'] = username;
        refreshInfo['token'] = token;

        var refreshInfoJson = JSON.stringify(refreshInfo);
        // alert(loginInfoJson);

        var request = new XMLHttpRequest();
        var result = null;

        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                result = this.responseText;  // get 'available' information and show user info
                // alert(result);
                if (!result) {
                    return  // show nothing
                } else {
                    // update user info
                    document.getElementById('userInfo').innerHTML = '<span class="glyphicon glyphicon-user"></span> ' +  username + ' <span class="caret"></span>';
                    if (result !== 'Y') {
                        document.getElementById('state').innerHTML = '<a href="#"><mark>状态</mark>: 未通过</a>'
                    }

                    // hide login button, show user info
                    document.getElementById('dmLogin').style.display = 'none';
                    document.getElementById('welcome').style.display = 'block';

                    // notify user, display after ten seconds
                    var notification = document.getElementById('notifyStore');
                    notification.style.display = 'block';
                    setTimeout(function () {
                        notification.style.display = 'none';
                    }, 10000);
                }
            }
        };
        request.open("POST", "php/refreshCheck.php", true);
        request.setRequestHeader("Content-type", "application/json");
        request.send(refreshInfoJson);
    }
});

$(document).ready(function () {
    $(this).scrollTop(0);
});
