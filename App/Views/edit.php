<div id="sp-header-edit"class="container-fluid">
    <div class="row">
	<div class="col-lg-8 col-lg-push-2 text-center">
	    <table class='table table-striped table-condensed'>
		<thead>
		    <tr>
			<td colspan="2">
			    <h3>Vos urls d'accées</h3>
			    <h5 class="text-danger">
				Seul vos urls peuvent decrypter votre écris, ne les perdaient pas.
			    </h5>
			</td>
		    </tr>
		</thead>
		<tbody>
		    <tr>
			<td class='text-right'><u>Editer</u></td>
		<td class='text-left'><b id="sp-url-edit"></b></td>
		</tr>
		<tr>
		    <td class='text-right'><u>Aperçu</u> </td>
		<td class='text-left'><b id="sp-url-preview"></b></td>
		</tr>
		<tr>
		    <td class='text-right'><u>En ligne</u></td>
		<td class='text-left'><b id="sp-url-view"></b></td>
		</tr>
		</tbody>
	    </table>
	</div>
    </div>
    <div id="sp-post" class="container" data-postid="<?= $article['id'] ?>">
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
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/content-tools.min.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/sjcl.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/editor.js"></script>
<script type="text/javascript">
    $(function () {
	var editor;
	var title = '<?= (!empty($article['title'])) ? $article['title'] : "Ton Titre" ?>';
	var article = '<?= (!empty($article['content'])) ? $article['content'] : "Ton Article" ?>';
	var signature = '<?= (!empty($article['author'])) ? $article['author'] : "Toi" ?>';
	loadContent(title, article, signature);
	var urlEdit = "<?= BASE_URL ?>edit/<?= $article['link'] ?>" + window.location.hash;
		var urlPreview = "<?= BASE_URL ?>preview/<?= $article['link'] ?>" + window.location.hash;
			var urlVIew = "<?= BASE_URL ?>view/<?= $article['link'] ?>" + window.location.hash;
				setPostUrls(urlEdit, urlPreview, urlVIew)
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
							    $('#location').html('Votre article est accéssible publiquement.');
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
									$('#location').html('Votre article est accéssible publiquement.');
									break;
								}
								$('#sp-post-status').html(html);
							    }, 'json');
							});
						    });
</script>