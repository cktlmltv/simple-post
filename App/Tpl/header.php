<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>App/Assets/images/noun_76598_cc.svg">
	<script type="text/javascript" src="<?= BASE_URL ?>vendor/components/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL ?>App/Assets/js/main.js"></script>
	<link href="<?= BASE_URL ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= BASE_URL ?>vendor/components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>App/Assets/css/content-tools.min.css">
	<link href="<?= BASE_URL ?>App/Assets/css/main.css" rel="stylesheet" type="text/css">
    </head>
    <body>
	<div class="navbar">
	    <div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button> 
		    <a class="navbar-brand" href="<?= BASE_URL ?>">
			<img class="img-responsive pull-left" src="<?= BASE_URL ?>App/Assets/images/noun_76598_cc.svg"  />
			<span>Simple Post</span>
		    </a> 
		</div>
		<?php
		switch ($header) {
		    case 'view':
			?>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			    <ul class="nav navbar-nav navbar-right"> 
				<li class="active" id="sp-link-edit"></li>
			    </ul>
			</div>
			<?php
			break;
		    case 'edit':
			?>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			    <ul class="nav navbar-nav navbar-right"> 
				<li class="active" id="sp-link-preview"></li>
				<li class="active" id="sp-link-view"></li>
				<li class="active" style="padding: 15px;">Status : <font id="sp-post-status"><?php
				    switch ($article['visibility']) {
					case 'draft':
					    ?>
					    <span class="label label-warning">Brouillon</span>
					    <?php
					    break;
					case 'live':
					    ?>
					    <span class="label label-success">En ligne</span>
					    <?php
					    break;
				    }
				    ?></font>
				</li>
			    </ul>
			</div>
			<?php
			break;
		}
		?>
	    </div>
	</div>
	<div id="main-content">

