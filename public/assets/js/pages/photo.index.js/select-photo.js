
function SelectPhoto() {
    this.initEvent();
}

SelectPhoto.prototype.validateTypeFile = function(oFile) {
    var rFilter = /^(?:image\/jpeg|image\/png)$/i;

    if (!rFilter.test(oFile.type)) {
        return false;
    }
    return true;
};

SelectPhoto.prototype.initEvent = function() {
    $("input[name='file-input-photo']").on('change', function(){
        if (!window.photoevent.selectPhoto.validateTypeFile($('#file-input-photo').get(0).files[0])) {
            window.photoevent.dialog.error('Erro','O arquivo deve possuir o formato jpeg ou png.');
            var input = $('#file-input-photo');
            input.replaceWith(input.val('').clone(true));
            return;
        }

        $("#form-send-photo").submit();
    });

    $("#download-button").click(function(event){
        event.preventDefault();
        $("#file-input-photo").click();
    });
};


window.photoevent = window.photoevent || {};
window.photoevent.selectPhoto = window.photoevent.selectPhoto || new SelectPhoto();