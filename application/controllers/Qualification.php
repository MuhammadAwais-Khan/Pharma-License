<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '4')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_qualification() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualification name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|is_unique[tbl_qualification.name]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->qualification_model->add_qualification();

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
		$data = $this->qualification_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_qualification() {

		$json = array();

		// $this->form_validation->set_rules('id', 'qualification ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualification name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
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
			$result = $this->qualification_model->update_qualification();

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

	public function view_qualification() {

		$data['page_title'] = 'View All qualifications';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('qualification/view_qualification', $data);
		$this->load->view('templates/footer');
	}

	public function get_qualification() {

		$data = $row = array();

		// Fetch qualification's records
		$qualificationData = $this->qualification_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($qualificationData as $qualificationInfo) {
			$i++;
			$status = ($qualificationInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($qualificationInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $qualificationInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '<a href="javascript:void(0)" onclick="getData(' . "'" . $qualificationInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $qualificationInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->qualification_model->countAll(),
			"recordsFiltered" => $this->qualification_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
