<div class="container">
    <div class="row">
	<div class="col-lg-6 col-lg-push-3 text-center">
	    <div class="form-group">
		<label for="exampleInputEmail1"><h3>Modifier votre article nécessite un mot de passe.</h3></label>
		<div class="input-group">
		    <span class="input-group-addon" id="pwd-addon" data-toggle="true"><i class="fa fa-eye"></i></span>
		    <input type="password" class="form-control" id="pwd" placeholder="Mot de passe">
		</div>
	    </div>
	    <button id="btn-edit" class="btn btn-warning">Editer</button>
	    <br/>
	    <br/>
	    <p id="msg" class="text-warning"></p>
	</div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
	$('#btn-edit').on('click', function () {
	    $.post('<?= BASE_URL ?>connect/<?= $article['id'] ?>', {password: $('#pwd').val()}, function (result) {
			    if (result.valid) {
				window.top.location = "<?= BASE_URL ?>edit/<?= $article['link'] ?>" + window.location.hash;
						} else {
						    $('#msg').html('Ton mot de passe ne correspond pas :/')
						}
					    }, 'json');
					});
				    });
</script>