<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institute extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '4')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_institute() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'institute name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|is_unique[tbl_institute.name]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->institute_model->add_institute();

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
		$data = $this->institute_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_institute() {

		$json = array();

		// $this->form_validation->set_rules('id', 'institute ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'institute name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
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
			$result = $this->institute_model->update_institute();

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

	public function view_institute() {

		$data['page_title'] = 'View All institutes';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('institute/view_institute', $data);
		$this->load->view('templates/footer');
	}

	public function get_institute() {

		$data = $row = array();

		// Fetch institute's records
		$instituteData = $this->institute_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($instituteData as $instituteInfo) {
			$i++;
			$status = ($instituteInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($instituteInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $instituteInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '<a href="javascript:void(0)" onclick="getData(' . "'" . $instituteInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $instituteInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->institute_model->countAll(),
			"recordsFiltered" => $this->institute_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
