const BASE_URL = 'http://localhost/';

function clearErrors() {
    $(".has-error").removeClass("has-error");
    $(".help-block").html("");
}

function showErrors(error_list) {
    clearErrors();
    $.each(error_list, function (id, message) {
        $(id).parent().parent().addClass("has-error");
        $(id).parent().siblings(".help-block").html(message);
    });
}

function showErrorsModal(error_list) {
    clearErrors();
    $.each(error_list, function (id, message) {
        $(id).parent().parent().addClass("has-error");
        $(id).siblings(".help-block").html(message);
    });
}

function loading(message = "") {
    return '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp' + message;
}

function uploadImage(file, img, path) {
    const img_before = img.attr('src');
    const imageFile = file[0].files[0];
    const formData = new FormData();
    formData.append('image_file', imageFile);
    $.ajax({
        url: BASE_URL + 'restrict/ajax_import_image',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'POST',
        beforeSend: function () {
            clearErrors()
            path.siblings(".help-block").html(loading("Carregando Imagem..."));
        },
        success: function (data) {
            clearErrors()
            if (data["status"] === '1' || data["status"] === 1) {
                img.attr('src', data["image_path"]);
                path.val(data["image_path"]);
            } else {
                img.attr('src', img_before);
                path.siblings(".help-block").html(data["error"]);
            }
        },
        error: function () {
            img.attr('src', img_before);
        }
    });
}