/**
 * @constructor
 */
function Instagram() {
    this.initialize();

    //Pages
    this.jsonParameterPages = {};
    this.jsonParameterPages.tag_name = "";
    this.jsonParameterPages.first = 0;
    this.jsonParameterPages.after = "";

    this.urlParametersPages = {};
    this.urlParametersPages.parameters = {};
    this.urlParametersPages.parameters.query_id = 17875800862117404;
    this.urlParametersPages.parameters.variables = "";
    this.urlParametersPages.url = "https://www.instagram.com/graphql/query/";

    //Explore Hashtag
    this.jsonParameterExploreHashtag = {};
    this.jsonParameterExploreHashtag.url = window.photoevent.urlbase + "/instagram/get/json/hashtag?name=";

}

Instagram.prototype.getVariablesPagesURL = function (page, tagName, after) {
    this.jsonParameterPages.first = parseInt(page);
    this.jsonParameterPages.tag_name = tagName;
    this.jsonParameterPages.after = after;

    var variables = JSON.stringify(this.jsonParameterPages);

    this.urlParametersPages.parameters.variables = variables;

    return this.urlParametersPages;
};

Instagram.prototype.getJSONPagesInstagram = function (page, tagName) {
    var urlParameter = this.getVariablesURL(page, tagName);

    returnSuccess = function (returnAjax) {
        console.log(returnAjax);
    };

    var configurationAjaxSend = window.photoevent.ajax.getDefaults();
    configurationAjaxSend.url = urlParameter.url;
    configurationAjaxSend.method = 'GET';
    configurationAjaxSend.type = 'json';
    configurationAjaxSend.sucess = returnSuccess;
    configurationAjaxSend.data = urlParameter.parameters;

    window.photoevent.ajax.send(configurationAjaxSend);

    return true;
};

Instagram.prototype.getJSONHashtag = function (hashtag) {

    //Creating url for hashtag
    var url = this.jsonParameterExploreHashtag.url + hashtag;

    returnSuccess = function (returnAjax) {
        window.photoevent.instagram.drawFirstPageInstagram(returnAjax);
    };

    var configurationAjaxSend = window.photoevent.ajax.getDefaults();
    configurationAjaxSend.url = url;
    configurationAjaxSend.method = 'GET';
    configurationAjaxSend.type = 'json';
    configurationAjaxSend.sucess = returnSuccess;

    window.photoevent.ajax.send(configurationAjaxSend);

    return true;
};

Instagram.prototype.hideAllElementsCanvas = function() {
    $('#list-photos-instagram-media').html('');
    $('#list-photos-instagram-top-posts').html('');
    $('#title-top-posts').addClass('hide');
    $('#title-media').addClass('hide');
};

Instagram.prototype.drawSessionMediaImage = function(jsonInstagram) {
    var nodeImages = jsonInstagram.tag.media.nodes;

    //Media
    html = "";
    bOpenRow = false;
    bCloseRow = true;
    iCounter = 0;
    nodeImages.forEach(function (image) {
        $('#title-media').removeClass('hide');
        if (!bOpenRow && bCloseRow) {
            html += "<div class=\"row\">";
            bOpenRow = true;
            bCloseRow = false;
        }
        ++iCounter;
        html += window.photoevent.instagram.drawCard(image.display_src);

        if (((iCounter % 3) == 0) && !bCloseRow) {
            html += "</div>";
            bCloseRow = true;
            bOpenRow = false;
        }
    });
    if (!bCloseRow) {
        html += "</div>";
    }

    $('#list-photos-instagram-media').append(html);

    return true;
};

Instagram.prototype.drawSessionTopPosts = function(jsonInstagram) {
    var topPosts = jsonInstagram.tag.top_posts.nodes;

    //Top Posts
    html = "";
    bOpenRow = false;
    bCloseRow = true;
    iCounter = 0;
    topPosts.forEach(function (image) {
        $('#title-top-posts').removeClass('hide');
        if (!bOpenRow && bCloseRow) {
            html += "<div class=\"row\">";
            bOpenRow = true;
            bCloseRow = false;
        }
        ++iCounter;
        html += window.photoevent.instagram.drawCard(image.display_src);

        if (((iCounter % 3) == 0) && !bCloseRow) {
            html += "</div>";
            bCloseRow = true;
            bOpenRow = false;
        }
    });
    if (!bCloseRow) {
        html += "</div>";
    }

    $('#list-photos-instagram-top-posts').append(html);

    return true;
};

Instagram.prototype.drawFirstPageInstagram = function (jsonInstagram) {
    this.hideAllElementsCanvas();

    this.drawSessionMediaImage(jsonInstagram);
    this.drawSessionTopPosts(jsonInstagram);
    return true;
};

Instagram.prototype.drawCard = function (srcImage) {
    return "     <div class=\"col s12 m4 l4\">\n" +
        "            <div class=\"card\">\n" +
        "                <div class=\"card-image\">\n" +
        "                    <img src=\"" + srcImage + "\">\n" +
        "                    <span class=\"card-title\"></span>\n" +
        "                    <a class=\"btn-floating halfway-fab waves-effect waves-light red btn-select-image\"><i class=\"fa fa-check\"></i></a>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>";
};

Instagram.prototype.initialize = function () {
    $('#btn-hashtag-instagram').click(function () {
        if ($('#hashtag-instagram').val() != "")
            window.photoevent.instagram.getJSONHashtag($('#hashtag-instagram').val());
    });

    $(document).on('click', '.btn-select-image', function() {
        $('#file-input-photo').val($(this).parent().find('img').attr("src"));
        $("#form-send-photo").submit();
    });
};

window.photoevent = window.photoevent || {};
window.photoevent.instagram = window.photoevent.instagram || new Instagram();