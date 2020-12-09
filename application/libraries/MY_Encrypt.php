<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class MY_Encrypt extends CI_Encryptionnnnn {

	function encrypt($string, $key = "", $url_safe = TRUE) {
		$ret = parent::encrypt($string, $key);

		if ($url_safe) {
			$ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
		}

		return $ret;
	}

	function decrypt($string, $key = "") {
		$string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));

		return parent::decrypt($string, $key);
	}

}

?>