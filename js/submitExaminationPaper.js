/**
 * Created by david on 2017/5/13.
 */
function submit() {
    // avoid ones = goodOnes
    var countColors = 0;
    Object.keys(goodOnes).forEach(function (p1, p2, p3) {
        countColors += document.getElementById(p1).classList.contains('panel-primary');
    });

    // one should answer all questions
    if (ones.length < 30 || countColors < 30) {
        alert('选项不能为空');
        return;
    }

    var username = document.cookie.replace(/(?:(?:^|.*;\s*)username\s*\=\s*([^;]*).*$)|^.*$/, '$1');
    var token = document.cookie.replace(/(?:(?:^|.*;\s*)token\s*\=\s*([^;]*).*$)|^.*$/, '$1');

    if (!username || !token) {
        if (!confirm('当前未登录，若继续提交则答题不计分')) {
            return;
        }
    }

    // check the paper
    var count = 0;  // right selections
    for (var i = 0; i < 30; i++) {
        var index = "select" + i;
        count += ones[index] == goodOnes[index]? true : false;  // base the fact: 1 + false == 1 & 1 + true = 2
    }

    var passed = document.getElementById('passed');

    if (!passed) {
        if (count > 26) {
            // the way that changing borrow permission is not security at all, as the demand showing correct answer
            // cookie is not none

            if (username && token) {
                var userInfo = {};
                userInfo['username'] = username;
                userInfo['token'] = token;

                var userInfoJson = JSON.stringify(userInfo);
                // alert(loginInfoJson);

                var request = new XMLHttpRequest();
                var result = null;

                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        result = this.responseText;  // get 'available' information and show user info
                        // alert(result);
                        if (!result) {
                            alert('发生了意外，请重新登录');
                        } else {
                            alert('恭喜通过测试，借阅权限已开通');
                        }
                    }
                };
                request.open("POST", "php/congratulations.php", true);
                request.setRequestHeader("Content-type", "application/json");
                request.send(userInfoJson);
            }
        } else {
            alert('正确率不及90%，继续加油');
        }
    } else if (document.getElementById('welcome').style.display !== "none") {
        if (confirm('已通过测试，是否刷分？')) {
            if (count > 26) {
                alert('刷分成功，侬很棒！');
            } else {
                alert('刷分失败，推荐联系相关老师回炉重造...');
            }
        } else {
            return;
        }
    } else {
        alert('答对 ' + count + ' 道题');
    }

    var comparison = null;
    var question = null;
    var lastSelection = null;
    Object.keys(ones).forEach(function (p1, p2, p3) {
        comparison = goodOnes[p1] == ones[p1]? false : goodOnes[p1];
        questionTemplate = document.getElementById(p1);
        if (!comparison) {
            questionTemplate.classList.toggle('panel-success');
        } else {
            questionTemplate.classList.toggle('panel-danger');
            lastSelection = questionTemplate.lastElementChild;
            lastSelection.insertAdjacentHTML('beforeEnd', '<div class="alert alert-danger alert-dismissable" style="margin-top: 5px; margin-bottom: 0px">' +
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
                '正确选项为 <code>' + comparison +
                '</code></div>');
        }
    });

    // avoid submitting examination paper several times.
    var y = document.getElementById('submit');
    y.classList.add('disabled');  // from visual perspective
    y.onclick = function () { alert('已提交结果，请刷新界面重新答题'); };  // from function perspective

    // alert(ones.select1);  // 'ones' of the 'index.html' is available in external js file.
}