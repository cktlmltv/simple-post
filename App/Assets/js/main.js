$(function () {
    $('#pwd-addon').on('click', function () {
	if ($(this).data('toggle')) {
	    $(this).html('<i class="fa fa-eye-slash"></i>');
	    $(this).data('toggle', false);
	    $('#pwd').attr('type', 'text');
	} else {
	    $(this).html('<i class="fa fa-eye"></i>');
	    $(this).data('toggle', true);
	    $('#pwd').attr('type', 'password');
	}
    });
})
function setPostUrls(urlEdit, urlPreview, urlVIew) {
    $("#sp-link-edit").html('<a href="' + urlEdit + '">Modifier</a>');
    $("#sp-link-preview").html('<a href="' + urlPreview + '">Aperçu</a>');
    $("#sp-link-view").html('<a href="' + urlVIew + '">Voir</a>');
    $("#sp-url-edit").html('<span id="sp-url-edition">' + urlEdit + '</span> <a href="' + urlEdit + '" rel="sidebar"  data-key="sp-url-edition" class="sp-bm-btn btn btn-warning btn-xs"> Pin!</a>');
    $("#sp-url-preview").html('<span id="sp-url-previewer">' + urlPreview + '</span> <a href="' + urlPreview + '" rel="sidebar" data-key="sp-url-previewer" class="sp-bm-btn btn btn-warning btn-xs"> Pin!</a>');
    $("#sp-url-view").html('<span id="sp-url-viewer">' + urlVIew + '</span> <a href="' + urlVIew + '" rel="sidebar" data-key="sp-url-viewer" class="sp-bm-btn btn btn-warning btn-xs"> Pin!</a>');

    $(".sp-bm-btn").click(function () {
	var url = $('#' + $(this).data('key')).html();
	var title = "Simple Post";
	if (window.sidebar && typeof window.sidebar.addPanel != "undefined") {
	    window.sidebar.addPanel(title, url, "");
	} else if (document.all) {
	    window.external.AddFavorite(url, title);
	} else if (window.opera && window.print) {
	    alert('Press ctrl+D to bookmark (Command+D for macs) after you click Ok');
	} else if (window.chrome) {
	    alert('Press ctrl+D to bookmark (Command+D for macs) after you click Ok');
	}
	return false;
    });
}
function guid() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
	    s4() + '-' + s4() + s4() + s4();
}

function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
	    .toString(16)
	    .substring(1);
}
function loadContent(title, article, signature) {
    var p, rp = {};
    p = {ks: 256};
    var hash = window.location.hash;
    if (isValidJSON(title)) {
	var plaintext = sjcl.decrypt(hash, title, {}, rp);
	$('.sp-title').html(plaintext);
    }
    if (isValidJSON(article)) {
	plaintext = sjcl.decrypt(hash, article, {}, rp);
	$('.sp-post').html(plaintext);
    }
    if (isValidJSON(signature)) {
	plaintext = sjcl.decrypt(hash, signature, {}, rp);
	$('.sp-sign').html(plaintext);
    }
}
function isValidJSON(string) {
    try {
	JSON.parse(string);
    } catch (e) {
	return false;
    }

    return true;
}