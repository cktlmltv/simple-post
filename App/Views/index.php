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
<div id='sp-trash-form'></div>
<div id='sp-explain' class="section">
    <div class="container">
	<div class="row text-center">
	    <div class="col-md-4">
		<div class="sp-explain-img">
		    <img width="120"  src="<?= BASE_URL ?>App/Assets/images/noun_375517_cc.svg"/>
		</div>
		<h3>Hébergement du billet</h3>
		<p>
		    Simple et facile, vous n'avez qu'a écrire votre billet! <br/>
		    <a href="<?= BASE_URL ?>/edit/demo#b8ee4749-6be7-8e75-076f-4660282fb4fd">Démo en ligne</a><br/>
		    Mot de passe : demo
		</p>
	    </div>
	    <div class="col-md-4">
		<div class="sp-explain-img">
		    <img width="120" src="<?= BASE_URL ?>App/Assets/images/noun_76584_cc.svg"/>
		</div>

		<h3>Aucun regard sur le contenu</h3>
		<p>
		    Vos écris sont crypté dés l'envoie vers les serveur,<br/>
		    La clés de chiffrement est uniquement dans les urls généré.
		</p>
	    </div>
	    <div class="col-md-4">
		<div class="sp-explain-img">
		    <img width="120"  src="<?= BASE_URL ?>App/Assets/images/noun_669.svg"/>
		</div>

		<h3>Open source</h3>
		<p>
		    Les sources sont disponible sur <a href="https://github.com/cktlmltv/simple-post" target="_blank">github</a>
		    <br/>
		    Les sources sont publiées dans le domaine public (<a href="https://raw.githubusercontent.com/cktlmltv/simple-post/master/LICENSE" target="_blank">Licence</a>).
		</p>
	    </div>
	</div>
    </div>
</div>
<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/sjcl.js"></script>
<script type="text/javascript">
    $(function () {
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
    })
</script>