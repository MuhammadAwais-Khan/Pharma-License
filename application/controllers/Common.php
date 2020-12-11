<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

	}

	// tbl_name_id is ID
	public function pendency_report() {
		$data['page_title'] = 'Pendency Report';
		$data['description'] = '...';

		$this->load->view('templates/header', $data);
		$this->load->view('print/pendency_report', $data);
		$this->load->view('templates/footer');
	}
	public function dg_drug_pendency_report() {
		$postData = $this->input->post();
		$data = $this->common_model->dg_drug_pendency_report($postData);
		echo json_encode($data);
	}
	public function inspector_pendency_report() {
		$postData = $this->input->post();
		$data = $this->common_model->inspector_pendency_report($postData);
		echo json_encode($data);
	}

	public function form_reports() {

		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}

		$data['form_type'] = $this->common_model->fetchAllRecordsOrderByGroupBy('tbl_form_type', array('status' => '1'), $order = 'name asc', $group_by = null);
		$data['district'] = $this->common_model->fetchAllRecordsOrderByGroupBy('tbl_district', array('status' => '1'), $order = 'name asc', $group_by = null);
		$data['page_title'] = 'Froms Licenses Reports';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('print/form_reports', $data);
		$this->load->view('templates/footer');
	}

	public function get_form_report() {
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->common_model->get_form_report($postData);

		echo json_encode($data);
	}

	// tbl_name_id is ID
	public function pdf($tbl_name, $tbl_name_id) {
		$id = safe_decode($tbl_name_id);
		$tbl_name = safe_decode($tbl_name);

		$data['all'] = $this->common_model->getRecordById($id, $tbl_name);
		// $this->load->view('print/print_pdf', $data);
		$this->load->library('pdf');
		$html = $this->load->view('print/print_pdf', $data, true);

		$this->pdf->createPDF($html, $data['all']['tracking_code'], true);

	}

	// tbl_name_id is ID
	public function print_license($tbl_name, $tbl_name_id) {
		$id = safe_decode($tbl_name_id);
		$tbl_name = safe_decode($tbl_name);

		$data['id'] = $id;

		// $this->load->view('templates/header', $data);
		if ($tbl_name == 'tbl_form_8a') {
			// $this->load->view('print/print_form_8a', $data);

			$this->load->library('pdf');
			$html = $this->load->view('print/print_form_8a', $data, true);
			$this->pdf->createPDF($html, 'Form 8A (Pharmacy) License', true);
		}

		if ($tbl_name == 'tbl_form_8b') {
			// $this->load->view('print/print_form_8b', $data);
			$this->load->library('pdf');
			$html = $this->load->view('print/print_form_8b', $data, true);
			$this->pdf->createPDF($html, 'Form 8B (Retail Store) License', true);
		}

		if ($tbl_name == 'tbl_form_8c') {
			// $this->load->view('print/print_form_8c', $data);
			$this->load->library('pdf');
			$html = $this->load->view('print/print_form_8c', $data, true);
			$this->pdf->createPDF($html, 'Form 8C (Whole Sale) License', true);
		}

		if ($tbl_name == 'tbl_form_8d') {
			// $this->load->view('print/print_form_8d', $data);
			$this->load->library('pdf');
			$html = $this->load->view('print/print_form_8d', $data, true);
			$this->pdf->createPDF($html, 'Form 8D (Narcotics) License', true);
		}

		// $this->load->view('templates/footer');
	}

	public function logger($id, $tbl_name) {

		if (empty($id)) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
		$id = safe_decode($id);
		$data['id'] = $id;

		$data['all'] = $this->common_model->getAllRecordByArray('tbl_log', array('tbl_name' => $tbl_name, 'tbl_name_id' => $id));

		$data['page_title'] = 'Timeline';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/log', $data);
		$this->load->view('templates/footer');
	}

	public function fetchDistrictByProvinceID($tbl_province_id) {
		$data = $this->common_model->fetchDistrictByProvinceID($tbl_province_id);
		echo json_encode($data);
	}

	public function fetchTehsilByDistrictID($tbl_district_id) {
		$data = $this->common_model->fetchTehsilByDistrictID($tbl_district_id);
		echo json_encode($data);
	}

	public function getProprietor($id) {
		$data = $this->common_model->getProprietor($id);
		echo json_encode($data);
	}

	public function getPharmacist($id) {
		$data = $this->common_model->getPharmacist($id);
		echo json_encode($data);
	}

	public function getOtherPharmacist($id) {
		$data = $this->common_model->getOtherPharmacist($id);
		echo json_encode($data);
	}

}