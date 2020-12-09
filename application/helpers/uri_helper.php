<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('safe_encode')) {
	function safe_encode($string = '', $url_safe = TRUE) {
		$CI = &get_instance();
		$CI->load->library('encryption');

		$ret = $CI->encryption->encrypt($string);

		if ($url_safe) {
			$ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
		}

		return $ret;
	}
}

if (!function_exists('safe_decode')) {
	function safe_decode($string = '') {
		$CI = &get_instance();
		$CI->load->library('encryption');

		$string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));

		return $CI->encryption->decrypt($string);
	}
}
