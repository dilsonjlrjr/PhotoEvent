
function CropPhoto() {
    this.initEvent();
}

CropPhoto.prototype.initEvent = function() {
    $('#modal-preview').modal();

    $("#create-image").click(function () {
        $('.js-crop').click();

        var data = { "option-template" : $("input[name='option-template']:checked").val(), "image" : $("#image-hidden").val() };

        returnSuccess = function(returnAjax) {
            $("#img-preview-photo").prop("src", returnAjax.pictureedit);
            // $("#img-preview-photo").attr("path", returnAjax.filenamepath);
            $('#modal-preview').modal('open');
        };

        var configurationAjaxSend = window.photoevent.ajax.getDefaults();
        configurationAjaxSend.url = window.photoevent.urlbase + window.photoevent.routes_name.PHOTO_EVENT_MAKEPHOTO;
        configurationAjaxSend.method = 'POST';
        configurationAjaxSend.type = 'json';
        configurationAjaxSend.sucess = returnSuccess;
        configurationAjaxSend.data = data;

        window.photoevent.ajax.send(configurationAjaxSend);
    });
};


window.photoevent = window.photoevent || {};
window.photoevent.cropPhoto = window.photoevent.cropPhoto || new CropPhoto();