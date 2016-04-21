</div>
<script type="text/javascript">
<?php
if ($header == 'view' || $header == 'edit') {
    ?>
        $(function () {
    	var urlEdit = "<?= BASE_URL ?>edit/<?= $article['link'] ?>" + window.location.hash;
    		var urlVIew = "<?= BASE_URL ?>view/<?= $article['link'] ?>" + window.location.hash;
    			$("#sp-link-edit").html('<a href="' + urlEdit + '">Modifier</a>');
    			$("#sp-link-view").html('<a href="' + urlVIew + '">Voir</a>');
    		    })

    <?php
}
?>

</script>
</body>
</html>