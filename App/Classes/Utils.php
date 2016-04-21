<?php

namespace App\Classes;

class Utils {

    static function generatePostUrl($postUrl) {
	$postUrl = strtolower($postUrl);
	$postUrl = rtrim($postUrl);
	$postUrl = str_replace(' ', '-', $postUrl);
	$postUrl = self::remove_accents($postUrl);
	return $postUrl;
    }

    static function remove_accents($str, $charset = 'utf-8') {
	$str = htmlentities($str, ENT_NOQUOTES, $charset);
	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
	return $str;
    }

}
