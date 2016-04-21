<div id="sp-post" class="container">
    <div class="row">
	<div class="col-lg-6 col-lg-push-3">
	    <?php
	    switch ($article['visibility']) {
		case "live" :
		    ?>
		    <div class="sp-title" data-name="title"><?= $article['title'] ?></div>
		    <br/>
		    <div class="sp-post" data-name="article"><?= $article['content'] ?></div>
		    <br/>
		    <div class="sp-sign" data-name="signature"><?= $article['author'] ?></div>
		    <br/>
		    <?php
		    break;
		case "draft":
		    ?>
		    Ce post n'est pas public! 
		    <?php
		    break;
		default:
		    ?>
		    No post !! 
		<?php
	    }
	    ?>
	</div>
    </div>
</div>
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/sjcl.js"></script>
<script type="text/javascript">
    $(function () {
	var title = '<?= $article['title'] ?>';
	var article = '<?= $article['content'] ?>';
	var signature = '<?= $article['author'] ?>';
	loadContent(title, article, signature);
	var urlEdit = "<?= BASE_URL ?>edit/<?= $article['link'] ?>" + window.location.hash;
		var urlVIew = "<?= BASE_URL ?>view/<?= $article['link'] ?>" + window.location.hash;
			setPostUrls(urlEdit, urlVIew)
		    })
</script>
