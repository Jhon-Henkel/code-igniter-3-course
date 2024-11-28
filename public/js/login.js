$(function () {
    $("#login_form").submit(function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/restrict/ajax_login",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function () {
                clearErrors();
                $("#btn_login").parent().siblings(".help-block").html(loading("Verificando..."))
            },
            success: function (response) {
                clearErrors();
                if (response["status"] === '1' || response["status"] === 1) {
                    $("#btn_login").parent().siblings(".help-block").html(loading("Logando..."))
                    window.location = BASE_URL + "restrict";
                } else {
                    showErrors(response["error_list"]);
                }
            }
        })
        return false;
    })
})