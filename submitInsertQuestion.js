/**
 * Created by david on 2017/5/5.
 */
function submitInsertQuestion(id) {
    var header = $('#iHeader').val();
    if (!header) {
        alert('Please input question head.');
        return;
    }

    var arr = new Array(4);
    arr[0] = $('#iA').val();
    arr[1] = $('#iB').val();
    if ((!arr[0]) || (!arr[1])) {
        alert('A valid question at least have two options.');
        return;
    }

    arr[2] = $('#iC').val();
    arr[3] = $('#iD').val();
    var options = arr.join('|');
    // alert(options);

    var answer = $('input[name=iSelector]:checked').val();
    if (!answer) {
        alert('Please select a right answer.');
        return;
    }

    var isRequired = $('input[name=iIsRequired]:checked').val();

    var data = {};
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

        // var x = document.getElementById(id);
        // x.classList.add('disabled');
        // x.onclick = function () {
        //     alert('再次增添，请刷新界面。');
        // }
    };
    request.open("POST", "insertQuestion.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(data_json);
}


























