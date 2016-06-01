<?php
session_start();

use App\Models\Posts;

$composerLoader = require 'vendor/autoload.php';

require 'config.php';
$header = '';
$app = new \Slim\App(array(
    'debug' => true
	));

 header("Access-Control-Allow-Origin: *");

$app->get('/', function ($request, $response, $args) {
    $header = '';
    require_once './App/Tpl/header.php';
    require_once './App/Views/index.php';
    require_once './App/Tpl/footer.php';
});

$app->get('/edit/{page}', function ($request, $response, $args) {
    $header = 'edit';
    $oPost = new Posts();
    $article = $oPost->retrieve($args['page']);
    if ($article != null) {
	if ($_SESSION['edit']) {
	    require_once './App/Tpl/header.php';
	    require_once './App/Views/edit.php';
	    require_once './App/Tpl/footer.php';
	} else {
	    $_SESSION['goto'] = $args['page'];
	    header('Location: ' . BASE_URL . 'password/' . $args['page']);
	    exit;
	}
    } else {
	header('Location: ' . BASE_URL);
	exit;
    }
});

$app->get('/view/{page}', function ($request, $response, $args) {
    $header = 'view';
    if (!empty($args['page'])) {
	$oPost = new Posts();
	$article = $oPost->retrieve($args['page']);
	require_once './App/Tpl/header.php';
	require_once './App/Views/view.php';
	require_once './App/Tpl/footer.php';
    }
});
$app->get('/preview/{page}', function ($request, $response, $args) {
    $header = 'view';
    if (!empty($args['page']) && $_SESSION['edit']) {
	$oPost = new Posts();
	$article = $oPost->retrieve($args['page']);
	$article['visibility'] = "live";
	require_once './App/Tpl/header.php';
	require_once './App/Views/view.php';
	require_once './App/Tpl/footer.php';
    }
});

$app->get('/password/{page}', function ($request, $response, $args) {
    $header = '';
    if (!empty($args['page'])) {
	$oPost = new Posts();
	$article = $oPost->retrieve($args['page']);
	if ($article != null) {
	    require_once './App/Tpl/header.php';
	    require_once './App/Views/password.php';
	    require_once './App/Tpl/footer.php';
	} else {
	    header('Location: ' . BASE_URL);
	    exit;
	}
    }
});

$app->post('/createPage', function ($request, $response, $args) {
    if (isset($_POST['tobor']) && $_POST['tobor'] == 1 && isset($_POST['page']) && !empty($_POST['page'])) {
	$oPost = new Posts();
	if (is_null($oPost->retrieve($_POST['page']))) {
	    $result = $oPost->create($_POST['page'], $_POST['title'], $_POST['password']);
	    echo json_encode($result);
	} else {
	    echo json_encode(array("msg" => 'Votre article éxiste déjà :/<br/> Il est accéssible <a href="' . BASE_URL . "edit/" . $_POST['page'] . '">ici<a/>.  '));
	}
    }
});

$app->post('/saveArticle/{id}', function ($request, $response, $args) {
    if (isset($_POST['title']) || isset($_POST['article']) || isset($_POST['signature'])) {
	$oPost = new Posts();
	$title = (isset($_POST['title'])) ? $_POST['title'] : null;
	$article = (isset($_POST['article'])) ? $_POST['article'] : null;
	$signature = (isset($_POST['signature'])) ? $_POST['signature'] : null;
	$result = $oPost->update($args['id'], $title, $article, $signature);
	echo json_encode($result);
    }
});

$app->post('/publishArticle/{id}', function ($request, $response, $args) {
    $oPost = new Posts();
    $result = $oPost->published($args['id']);
    echo json_encode($result);
});

$app->post('/draftArticle/{id}', function ($request, $response, $args) {
    $oPost = new Posts();
    $result = $oPost->drafted($args['id']);
    echo json_encode($result);
});




$app->post('/connect/{id}', function ($request, $response, $args) {
    $oPost = new Posts();
    $result = array('valid' => false);
    if (isset($_POST['password']))
	$result = $oPost->password($args['id'], $_POST['password']);

    if ($result['valid']) {
	$_SESSION['edit'] = true;
    }
    echo json_encode($result);
});

$app->run();
?>