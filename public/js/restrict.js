$(function ()  {
    $("#btn_add_course").click(function () {
        clearErrors();
        $("#form_course")[0].reset();
        $("#course_img_path").attr("src", "");
        $("#modal_course").modal();
    })

    $("#btn_add_member").click(function () {
        $("#modal_member").modal();
    })

    $("#btn_add_user").click(function () {
        $("#modal_user").modal();
    })

    $("#btn_upload_course_image").change(function () {
        uploadImage($(this), $("#course_img_path"),  $("#course_img"));
    })

    $("#btn_upload_member_image").change(function () {
        uploadImage($(this), $("#member_img_path"),  $("#member_img"));
    })

    $("#form_course").submit(function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "restrict/ajax_save_course",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function () {
                clearErrors();
                $("#btn_save_course").siblings(".help-block").html(loading("Salvando..."));
            },
            success: function (response) {
                clearErrors();
                if (response["status"] === 1) {
                    $("#modal_course").modal("hide");
                } else {
                    showErrorsModal(response["error_list"]);
                }
            }
        })
        return false
    })
})