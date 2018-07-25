$(document).ready(function () {
    var doExist = $("ul.globalErrors").length;

    if (doExist) {
        setTimeout(function () {
            $("ul.globalErrors").fadeOut(3000);
        }, 3000);
    }

    var doEventExist = $("ul.globalSuccess").length;

    if (doEventExist) {
        setTimeout(function () {
            $("ul.globalSuccess").fadeOut(3000);
        }, 3000);
    }

});