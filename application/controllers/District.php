<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class District extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();
		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_district() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'district name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'tbl_province_id' => form_error('tbl_province_id'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->district_model->add_district();

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
		$data = $this->district_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_district() {

		$json = array();

		// $this->form_validation->set_rules('id', 'district ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'district name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'tbl_province_id' => form_error('tbl_province_id'),
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->district_model->update_district();

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

	public function view_district() {
		$data['province'] = $this->common_model->getAllRecordByArray('tbl_province', array('status' => '1'));
		$data['page_title'] = 'View All district';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('district/view_district', $data);
		$this->load->view('templates/footer');
	}

	public function get_district() {

		$data = $row = array();

		// Fetch district's records
		$districtData = $this->district_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($districtData as $districtInfo) {
			$i++;
			$status = ($districtInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($districtInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $districtInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = '<i>Add by <strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$getProvince = $this->global->getRecordById($districtInfo->tbl_province_id, $tbl_name = 'tbl_province');

			$actionBtn =
			'<a href="javascript:void(0)" onclick="getData(' . "'" . $districtInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $getProvince['name'], $districtInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->district_model->countAll(),
			"recordsFiltered" => $this->district_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
