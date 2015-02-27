$(document).ready(function () {

    //Notice Funktionen
    var notice = $("div#notice").html();
    if (notice != "") {
        $("div#notice").show();

        setTimeout(function () {
            $("div#notice").fadeOut();
        }, 7500);
    }

    //Login Funktionen
    $("input[name='submitLogin']").click(function (event) {
        $("input[name='login-email']").css("border", "0px");
        $("input[name='login-passwort']").css("border", "0px");
        if ($("input[name='login-email']").val() == "") {
            event.preventDefault();
            $("input[name='login-email']").css("border", "2px solid red");
        }
        if ($("input[name='login-passwort']").val() == "") {
            event.preventDefault();
            $("input[name='login-passwort']").css("border", "2px solid red");
        }
    });
    //Register Funktionen
    $("input[name='submitRegister']").click(function (event) {
        $("input[name='email']").css("border", "0px");
        $("input[name='reg-passwort']").css("border", "0px");
        $("input[name='reg-passwort2']").css("border", "0px");
        if ($("input[name='email']").val() == "") {
            event.preventDefault();
            $("input[name='email']").css("border", "2px solid red");
        }
        if ($("input[name='reg-passwort']").val() == "") {
            event.preventDefault();
            $("input[name='reg-passwort']").css("border", "2px solid red");
        }
        if ($("input[name='reg-passwort2']").val() == "") {
            event.preventDefault();
            $("input[name='reg-passwort2']").css("border", "2px solid red");
        }
    });

    $("a").each(function (i) {
        if ($(this).attr("href").match("[?&]page=.+")) {
            if($(this).attr("href").match(".*" + getParam("page") + ".*")){
                $(this).css("background", "greenyellow");
                $(this).css("color", "black");
            }
        }
    });

});

function getParam(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}