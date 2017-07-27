/**
 * Created by davidmusk on 6/16/2017.
 */
$('#quit').on({
    click: function () {
        // reset cookie
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "token=;";


        setTimeout(function () {
            if (confirm('you sure?')) {
                window.location.reload(true);
            } else {
                return;
            }
        }, 1000)
    }
});