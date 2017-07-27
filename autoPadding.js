/**
 * Created by david on 2017/5/10.
 */
function autoPadding(id) {
    if (id.startsWith('update')) {
        var header = document.getElementById(id).innerText;
        $('#uHeader').val(header);

        var paddingValueID = "uPaddingValue" + id.slice(16);
        var paddingValue= document.getElementById(paddingValueID).innerText;
        var opts = paddingValue.split('&')[0];

        var answerID = 'uButton' + paddingValue.split('&')[1];
        var isRequiredID = 'uButton' + paddingValue.split('&')[2];

        $('#uA').val(opts.split('|')[0]);
        $('#uB').val(opts.split('|')[1]);
        $('#uC').val(opts.split('|')[2]);
        $('#uD').val(opts.split('|')[3]);
        document.getElementById(answerID).click();
        document.getElementById(isRequiredID).click();
        document.getElementById('toBeUpdatedID').innerHTML = id;

    } else if (id.startsWith('delete')) {
        var header = document.getElementById(id).innerText;
        $('#dHeader').val(header);

        var paddingValueID = "dPaddingValue" + id.slice(16);
        var paddingValue= document.getElementById(paddingValueID).innerText;
        var opts = paddingValue.split('&')[0];

        var answerID = 'dButton' + paddingValue.split('&')[1];
        var isRequiredID = 'dButton' + paddingValue.split('&')[2];

        $('#dA').val(opts.split('|')[0]);
        $('#dB').val(opts.split('|')[1]);
        $('#dC').val(opts.split('|')[2]);
        $('#dD').val(opts.split('|')[3]);
        document.getElementById(answerID).click();
        document.getElementById(isRequiredID).click();
        document.getElementById('toBeDeletedID').innerHTML = id;
        // $('#toBeDeleted').html(id);
    }
}