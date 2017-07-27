/**
 * Created by david on 2017/5/13.
 */
function submitUpdateQuestion(id) {
    var id = document.getElementById('toBeUpdatedID').innerText.slice(16);
    var header = $('#uHeader').val();

    var arr = new Array(4);
    arr[0] = $('#uA').val();
    arr[1] = $('#uB').val();
    arr[2] = $('#uC').val();
    arr[3] = $('#uD').val();
    var options = arr.join('|');
    // alert(options);

    var answer = $('input[name=uSelector]:checked').val();
    var isRequired = $('input[name=uIsRequired]:checked').val();

    var data = {};
    data['id'] = id;
    data['header'] = header;
    data['options'] = options;
    data['answer'] = answer;
    data['isRequired'] = isRequired;
    // alert(data);
    var data_json = JSON.stringify(data);
    // alert(data_json);

    var request = new XMLHttpRequest();
    var result = null;

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (!alert(result)) {
                window.location.reload(true);
            }
        }

        // var x = document.getElementById('uSubmit');
        // x.classList.add('disabled');
        // x.onclick = function () {
        //     alert('再次修改，请刷新界面');
        // }
    };
    request.open("POST", "php/updateQuestion.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(data_json);
}
