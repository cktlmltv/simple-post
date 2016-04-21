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
<script type="text/javascript">

    var title = '<?= $article['title'] ?>';
    var article = '<?= $article['content'] ?>';
    var signature = '<?= $article['author'] ?>';
    var p, rp = {};
    p = {ks: 256};
    function loadContent() {
	var hash = window.location.hash;
	try
	{
	    var json = JSON.parse(title);
	    if (json) {
		var plaintext = sjcl.decrypt(hash, title, {}, rp);
		$('.sp-title').html(plaintext);
	    }
	} catch (e) {
	}
	try
	{
	    var json = JSON.parse(article);
	    if (json) {
		plaintext = sjcl.decrypt(hash, article, {}, rp);
		$('.sp-post').html(plaintext);
	    }
	} catch (e) {
	}
	try
	{
	    var json = JSON.parse(signature);
	    if (json) {
		plaintext = sjcl.decrypt(hash, signature, {}, rp);
		$('.sp-sign').html(plaintext);
	    }
	} catch (e) {
	}
    }
    $(function () {

	loadContent();
    })


</script>