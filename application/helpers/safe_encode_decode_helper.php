<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function safe_encodeeeee($string) {

	$string = strtr(
		$string,
		array(
			'+' => '.',
			'=' => '-',
			'/' => '~',
		)
	);
	return $string;
}

function safe_decodeeeee($string) {

	// echo $string;exit;
	$string = strtr(
		$string,
		array(
			'.' => '+',
			'-' => '=',
			'~' => '/',
		)
	);
	return $string;
}

?>