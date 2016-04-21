(function () {
    var req;
    ContentTools.StylePalette.add([new ContentTools.Style('By-line', 'article__by-line', ['p']), new ContentTools.Style('Caption', 'article__caption', ['p']), new ContentTools.Style('Example', 'example', ['pre']), new ContentTools.Style('Example + Good', 'example--good', ['pre']), new ContentTools.Style('Example + Bad', 'example--bad', ['pre'])]);
    editor = ContentTools.EditorApp.get();
    editor.init('*[data-editable]', 'data-name');
    editor.addEventListener('saved', function (ev) {
	console.log(window.location.hash);
	var name, onStateChange, passive, payload, regions, xhr;
	// Check if this was a passive save
	passive = ev.detail().passive;

	// Check to see if there are any changes to save
	regions = ev.detail().regions;
	if (Object.keys(regions).length == 0) {
	    return;
	}

	// Set the editors state to busy while we save our changes
	this.busy(true);

	// Collect the contents of each region into a FormData instance
	payload = new FormData();
	payload.append('__page__', window.location.pathname);
	for (name in regions) {
	    hash = window.location.hash;
	    var p, rp = {};
	    p = {ks: 256};
	    /*** encrypt */
	    var json_sjcl = sjcl.encrypt(hash, regions[name], p, rp);
	    console.log(json_sjcl);
	    payload.append(name, json_sjcl);
	}

	// Send the update content to the server to be saved
	onStateChange = function (ev) {
	    // Check if the request is finished
	    if (ev.target.readyState == 4) {
		editor.busy(false);
		if (ev.target.status == '200') {
		    // Save was successful, notify the user with a flash
		    if (!passive) {
			new ContentTools.FlashUI('ok');
		    }
		} else {
		    // Save failed, notify the user with a flash
		    new ContentTools.FlashUI('no');
		}
	    }
	};
	console.log(onStateChange);
	xhr = new XMLHttpRequest();
	xhr.addEventListener('readystatechange', onStateChange);
	xhr.open('POST', 'http://127.0.0.1/single-post/saveArticle/' + $('#sp-post').data('postid'));
	xhr.send(payload);
    });
    req = new XMLHttpRequest();
    req.overrideMimeType('application/json');
    req.open('GET', 'https://raw.githubusercontent.com/GetmeUK/ContentTools/master/translations/lp.json', true);
    return req.onreadystatechange = function (ev) {
	var translations;
	if (ev.target.readyState === 4) {
	    translations = JSON.parse(ev.target.responseText);
	    ContentEdit.addTranslations('lp', translations);
	    return ContentEdit.LANGUAGE = 'lp';
	}
    };

}).call(this);