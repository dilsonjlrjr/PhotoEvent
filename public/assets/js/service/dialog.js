/**
 * Method dialog view
 * @returns {boolean}
 * @constructor
 */
function Dialog() {
    return true;
}

Dialog.prototype.error = function(title, message) {
    return swal({
        title: title,
        text: message,
        type: "error",
        timer: 5000
    });
};

Dialog.prototype.success = function(title, message) {
    return swal({
        title: title,
        text: message,
        type: "success",
        timer: 5000
    });
};

Dialog.prototype.warning = function(title, message) {
    return swal({
        title: title,
        text: message,
        type: "warning",
        timer: 5000
    });
};

Dialog.prototype.info = function(title, message) {
    return swal({
        title: title,
        text: message,
        type: "info",
        timer: 5000
    });
};

Dialog.prototype.question = function(title, message) {
    return swal({
        title: title,
        text: message,
        type: "question",
        timer: 5000
    });
};

window.photoevent = window.photoevent || {};
window.photoevent.dialog = window.photoevent.dialog || new Dialog();
