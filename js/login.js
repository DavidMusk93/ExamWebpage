/**
 * Created by davidmusk on 6/15/2017.
 */
var available;
$('#uSubmit').on({
    click: function () {
        if (!(document.getElementById('uSubmit').classList.contains('disabled'))) {
            var loginInfo = {};
            loginInfo['username'] = $('#username').val();
            if (!loginInfo['username']) {
                alert('请输入用户名！');
                return;
            }
            loginInfo['password'] = $('#password').val();
            if (!loginInfo['password']) {
                alert('请输入密码！');
                return;
            }

            var loginInfoJson = JSON.stringify(loginInfo);
            // alert(loginInfoJson);

            var request = new XMLHttpRequest();
            var result = null;

            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    result = this.responseText;
                    // alert(result);
                    if (!result) {
                        alert('username or password is incorrect, please check in your info.');
                    } else {
                        setCookie(loginInfo["username"], result.split('&')[0], 2);
                        // alert(result);

                        // whether user passed
                        available = result.split('&')[1];

                        // close modal by leveraging force
                        document.getElementById('uCancle').click();

                        // hide login button, show user info
                        document.getElementById('dmLogin').style.display = 'none';
                        document.getElementById('welcome').style.display = 'block';

                        // update user info
                        document.getElementById('userInfo').innerHTML = '<span class="glyphicon glyphicon-user"></span> ' +  loginInfo["username"] + ' <span class="caret"></span>';
                        if (available !== 'Y') {
                            document.getElementById('state').innerHTML = '<a href="#"><mark>状态</mark>: 未通过</a>'
                        }

                        // notify user, display after ten seconds
                        var notification = document.getElementById('notifySuccess');
                        notification.style.display = 'block';
                        setTimeout(function () {
                            notification.style.display = 'none';
                        }, 10000);
                    }
                }
            };
            request.open("POST", "php/login.php", true);
            request.setRequestHeader("Content-type", "application/json");
            request.send(loginInfoJson);
        }
    }
});