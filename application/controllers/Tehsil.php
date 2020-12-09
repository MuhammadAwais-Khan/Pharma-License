<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tehsil extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();
		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}

	public function fetchRecordsByProvinceID($tbl_province_id) {
		$data = $this->tehsil_model->fetchRecordsByProvinceID($tbl_province_id);
		echo json_encode($data);
	}

	public function add_tehsil() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'tehsil name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_district_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'tbl_province_id' => form_error('tbl_province_id'),
				'tbl_district_id' => form_error('tbl_district_id'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->tehsil_model->add_tehsil();

			$json = array(
				'success' => false,
			);
			if ($result) {
				$json = array(
					'success' => true,
				);
			}
			echo json_encode($json);
		}
		// echo json_encode($json);

	}

	public function getData($id) {
		$data = $this->tehsil_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_tehsil() {

		$json = array();

		// $this->form_validation->set_rules('id', 'tehsil ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'tehsil name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_district_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'tbl_province_id' => form_error('tbl_province_id'),
				'tbl_district_id' => form_error('tbl_district_id'),
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->tehsil_model->update_tehsil();

			$json = array(
				'success' => false,
			);
			if ($result) {
				$json = array(
					'success' => true,
				);
			}

			echo json_encode($json);
		}
		// echo json_encode($json);

	}

	public function view_tehsil() {
		$data['province'] = $this->common_model->getAllRecordByArray('tbl_province', array('status' => '1'));
		// $data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));
		$data['page_title'] = 'View All tehsil';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('tehsil/view_tehsil', $data);
		$this->load->view('templates/footer');
	}

	public function get_tehsil() {

		$data = $row = array();

		// Fetch tehsil's records
		$tehsilData = $this->tehsil_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($tehsilData as $tehsilInfo) {
			$i++;
			$status = ($tehsilInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($tehsilInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $tehsilInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = '<i>Add by <strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$getProvince = $this->global->getRecordById($tehsilInfo->tbl_province_id, $tbl_name = 'tbl_province');
			$getDistrict = $this->global->getRecordById($tehsilInfo->tbl_district_id, $tbl_name = 'tbl_district');

			$actionBtn =
			'<a href="javascript:void(0)" onclick="getData(' . "'" . $tehsilInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $getProvince['name'], $getDistrict['name'], $tehsilInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tehsil_model->countAll(),
			"recordsFiltered" => $this->tehsil_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
