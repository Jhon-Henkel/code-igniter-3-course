$(function ()  {
    $("#btn_add_course").click(function () {
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
})