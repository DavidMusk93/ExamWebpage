/**
 * Created by david on 2017/5/9.
 */
/*https://www.codeproject.com/Tips/201899/String-Format-in-JavaScript*/
String.prototype.format = function (args) {
    var str = this;
    return str.replace(String.prototype.format.regex, function (item) {
        var intVal = parseInt(item.substring(1, item.length-1));
        var replace;
        if (intVal >= 0) {
            replace = args[intVal]
        }
        return replace;
    })
};
String.prototype.format.regex = new RegExp("{[0-9]+}", "g");