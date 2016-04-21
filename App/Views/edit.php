<div id="sp-post" class="container" data-postid="<?= $article['id'] ?>">
    <div class="row">
	<div class="col-lg-6 col-lg-push-3">
	    <div data-editable class="sp-title" data-name="title"><p><?php
		    if (!empty($article['title'])) {
			echo $article['title'];
		    } else {
			echo "Titre de l'article";
		    }
		    ?></p></div>
	    <br/>
	    <div data-editable class="sp-post" data-name="article"><p><?php
		    if (!empty($article['content'])) {
			echo $article['content'];
		    } else {
			echo "Ton article";
		    }
		    ?></p></div>
	    <br/>
	    <div data-editable class="sp-sign" data-name="signature"><p><?php
		    if (!empty($article['author'])) {
			echo $article['author'];
		    } else {
			echo "Toi";
		    }
		    ?></p></div>
	    <br/>
	</div>
	<div class="col-lg-12 text-center">
	    <button id="btn-draft" class="btn btn-warning">Mettre en brouillon</button>
	    <button id="btn-publish" class="btn btn-success">Publier en ligne</button>
	    <br/>
	    <br/>
	    <p id="location"></p>
	</div>
    </div>
</div>
<script type="text/javascript">
    var editor;
    var hash = "blablabla";
    var title = '<?= (!empty($article['title'])) ? $article['title'] : "Ton Titre" ?>';
    var article = '<?= (!empty($article['content'])) ? $article['content'] : "Ton Article" ?>';
    var signature = '<?= (!empty($article['author'])) ? $article['author'] : "Toi" ?>';
    var p, rp = {};
    p = {ks: 256};
    function loadContent() {
	var hash = window.location.hash;
	var plaintext = sjcl.decrypt(hash, title, {}, rp);
	$('.sp-title').html(plaintext);
	plaintext = sjcl.decrypt(hash, article, {}, rp);
	$('.sp-post').html(plaintext);
	plaintext = sjcl.decrypt(hash, signature, {}, rp);
	$('.sp-sign').html(plaintext);
    }
    $(function () {
	loadContent();
	$('#btn-publish').on('click', function () {
	    $.post('<?= BASE_URL ?>publishArticle/<?= $article['id'] ?>', function (result) {
			    var html = '';
			    switch (result.visibility) {
				case 'draft':
				    html = '<span class="label label-warning">Brouillon</span>';
				    $('#location').html('Votre article est accéssible uniquement en édition.');
				    break;
				case 'live':
				    html = '<span class="label label-success">En ligne</span>';
				    var url = '<?= BASE_URL ?>view/' + result.link + window.location.hash;
				    $('#location').html('Votre article est accéssible publiquement ici : <a href="' + url + '">' + url + '</a>');
				    break;
			    }
			    $('#sp-post-status').html(html);
			}, 'json');
		    });

		    $('#btn-draft').on('click', function () {
			$.post('<?= BASE_URL ?>draftArticle/<?= $article['id'] ?>', function (result) {
					var html = '';
					switch (result.visibility) {
					    case 'draft':
						html = '<span class="label label-warning">Brouillon</span>';
						$('#location').html('Votre article est accéssible uniquement en édition.');
						break;
					    case 'live':
						html = '<span class="label label-success">En ligne</span>';
						$('#location').html('Votre article est accéssible publiquement ici : <a href="' + '<?= BASE_URL ?>view/' + result.link + '>"<?= BASE_URL ?>view/' + result.link + '</a>');
						break;
					}
					$('#sp-post-status').html(html);
				    }, 'json');
				});

			    });

</script>
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/editor.js"></script>