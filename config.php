<?php

switch ($_SERVER['SERVER_NAME']) {
    case 'www.simplepost.xyz' : case 'simplepost.xyz' :
	define('BASE_URL', 'http://www.simplepost.xyz/');
	define('HOST', 'localhost');
	define('DBNAME', 'simple-post');
	define('USERNAME', 'sp');
	define('PASSWORD', 'S1mplePost#!62');
	break;
    default :
	define('BASE_URL', 'http://127.0.0.1/single-post/');
	define('HOST', 'localhost');
	define('DBNAME', 'single-post');
	define('USERNAME', 'root');
	define('PASSWORD', 'root');
}

ORM::configure('mysql:host=' . HOST . ';dbname=' . DBNAME);
ORM::configure('username', USERNAME);
ORM::configure('password', PASSWORD);
