<?php
switch ($_SERVER['SERVER_NAME']) {
    case 'simplepost.xyz' :
        define('BASE_URL','http://www.simplepost.xyz//single-post/');
        define('HOST','localhost');
        define('DBNAME','single-post');
        define('USERNAME','root');
        define('PASSWORD','root');
    default :
        define('BASE_URL','http://127.0.0.1/single-post/');
        define('HOST','localhost');
        define('DBNAME','single-post');
        define('USERNAME','root');
        define('PASSWORD','root');
}

ORM::configure('mysql:host='.HOST.';dbname='.DBNAME);
ORM::configure('username', USERNAME);
ORM::configure('password', PASSWORD);
