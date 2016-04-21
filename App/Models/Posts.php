<?php

namespace App\Models;

use App\Classes\Utils;
use ORM;

Class Posts {

    public function __construct() {
	
    }

    public function retrieve($title) {
	$post = ORM::for_table('posts')->where_like('link', "%$title%")->find_one();
	if (!empty($post))
	    $post = $post->as_array();
	else
	    $post = null;
	return $post;
    }

    public function create($page = "", $title = "", $pwd = "") {
	$post = ORM::for_table('posts')->create();
	$post->link = Utils::generatePostUrl($page);
	$post->password = sha1($pwd);
	$post->revision = "0.0";
	$post->visibility = "draft";
	$post->dateRegistered = time();
	$post->dateUpdated = time();
	$post->save();
	$post = $post->as_array();
	return $post;
    }

    public function update($id, $title = null, $content = null, $author = null) {
	$post = $post = ORM::for_table('posts')->where('id', $id)->find_one();
	$update = false;
	if (!is_null($title)) {
	    $post->title = $title;
	    $update = true;
	}
	if (!is_null($content)) {
	    $post->content = $content;
	    $update = true;
	}
	if (!is_null($author)) {
	    $post->author = $author;
	    $update = true;
	}
	if ($update) {
	    $post->revision = (float) $post->revision + 0.1;
	    $post->dateRegistered = time();
	    $post->dateUpdated = time();
	    $post->save();
	}
	$post = $post->as_array();
	return $post;
    }

    public function published($id) {
	$post = $post = ORM::for_table('posts')->where('id', $id)->find_one();
	$post->visibility = "live";
	$post->save();
	$post = $post->as_array();
	return $post;
    }

    public function drafted($id) {
	$post = $post = ORM::for_table('posts')->where('id', $id)->find_one();
	$post->visibility = "draft";
	$post->save();
	$post = $post->as_array();
	return $post;
    }

    public function password($id, $password) {
	$result = array('valid' => false);
	$aPostData = $this->getPostById($id);
	if (!is_null($aPostData) && $aPostData['password'] == sha1($password)) {
	    $result = array('valid' => true);
	}

	return $result;
    }

    private function getPostById($id) {
	$post = ORM::for_table('posts')->where_like('id', $id)->find_one();
	if (!empty($post))
	    $post = $post->as_array();
	else
	    $post = null;
	return $post;
    }

}
