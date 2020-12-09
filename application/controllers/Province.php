<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_province() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'province name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|is_unique[tbl_province.name]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->province_model->add_province();

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
		$data = $this->province_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_province() {

		$json = array();

		// $this->form_validation->set_rules('id', 'province ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'province name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->province_model->update_province();

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

	public function view_province() {

		$data['page_title'] = 'View All provinces';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('province/view_province', $data);
		$this->load->view('templates/footer');
	}

	public function get_province() {

		$data = $row = array();

		// Fetch province's records
		$provinceData = $this->province_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($provinceData as $provinceInfo) {
			$i++;
			$status = ($provinceInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getprovince = $this->global->getRecordById($provinceInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $provinceInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getprovince['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '<a href="javascript:void(0)" onclick="getData(' . "'" . $provinceInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $provinceInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->province_model->countAll(),
			"recordsFiltered" => $this->province_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
