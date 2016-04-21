<div class="container-fluid">
    <div id='sp-create-form' class="jumbotron">
	<div class="row">
	    <div class="col-md-6 text-right">
		<h3>Publier en ligne un simple billet !</h3>
		<h4>Une idée, est internet pour la diffusée.</h4>
	    </div>
	    <div class="col-md-3">
		<div id="pageForm" class="form-group">
		    <p id="msg"></p>
		    <input id="page" type="text" class="first form-control" placeholder="Page">
		    <div class="input-group">
			<span class="input-group-addon last" id="pwd-addon" data-toggle="true"><i class="fa fa-eye"></i></span>
			<input id="pwd" type="password" class="last form-control" placeholder="Mot de passe">
		    </div>
		</div>
		<button id="btn-create" class="btn btn-warning">Créer ton poste</button>
	    </div>
	</div>
    </div>
</div>
<div class='trash'></div>
<div id='sp-explain' class="section">
    <div class="container">
	<div class="row">
	    <div class="col-md-12">
		<h1 class="text-center text-primary">Comment ?</h1>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-4">
		<h4>Hébergement du billet</h4>
	    </div>
	    <div class="col-md-4">
		<h4>Aucun regard sur le contenu</h4>
	    </div>
	    <div class="col-md-4">
		<h4>Un versionning du billet</h4>
	    </div>
	</div>
    </div>
</div>
<script type="text/javascript">
    function guid() {
	return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
		s4() + '-' + s4() + s4() + s4();
    }

    function s4() {
	return Math.floor((1 + Math.random()) * 0x10000)
		.toString(16)
		.substring(1);
    }
    $('#btn-create').on('click', function () {
	var page = $('#page').val();
	var password = $('#pwd').val();
	var hash = guid();
	var p, rp = {};
	p = {ks: 256};
	/*** encrypt */
	var title = sjcl.encrypt(hash, page, p, rp);
	var tobor = ($('input[name=tobor]').is(':checked')) ? 1 : 0;
	$.post('<?= BASE_URL ?>createPage', {page: page, title: title, password: password, tobor: tobor}, function (result) {
	    if (typeof result.link != "undefined") {
		window.top.location = "<?= BASE_URL ?>edit/" + result.link + "#" + hash;
	    } else if (typeof result.msg != "undefined")
		$('#msg').html(result.msg);
	}, 'json');
    });
    $('<br/><label><input type="checkbox" name="tobor" required="true"> &nbsp; Je ne suis pas un robot</label>').appendTo($('#pageForm'));
</script>