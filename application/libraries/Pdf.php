<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/dompdf/autoload.inc.php';

class Pdf {
	function createPDF($html, $filename = '', $download = TRUE, $paper = 'A4', $orientation = 'portrait') {

		// Load dompdf and create object
		require_once 'dompdf/autoload.inc.php';
		$options = new Dompdf\Options();
		// $options->set('tempDir', __DIR__ . '/site_uploads/dompdf_temp');
		$options->set('tempDir', __DIR__ . '/dompdf_temp');
		//
		$options->set('isRemoteEnabled', TRUE);
		$options->set('debugKeepTemp', TRUE);
		$options->set('chroot', '/'); // Just for testing :)
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf\Dompdf($options);

		// $dompdf = new Dompdf\Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->render();
		// $dompdf->set_base_path(site_url('assets/js/') . 'bootstrap.min.css');

		if ($download) {
			$dompdf->stream($filename . '.pdf', array('Attachment' => 1));
		} else {
			$dompdf->stream($filename . '.pdf', array('Attachment' => 0));
		}

	}
}
?>