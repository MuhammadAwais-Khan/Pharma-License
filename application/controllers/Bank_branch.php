<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_branch extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_bank_branch() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'bank_branch name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|is_unique[tbl_bank_branch.name]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

		$this->form_validation->set_rules('branch_code', ucwords(str_replace('_', ' ', 'bank_branch code')), 'required|xss_clean|trim|min_length[3]|max_length[25]|is_unique[tbl_bank_branch.branch_code]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

		$this->form_validation->set_rules('tbl_banks_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'branch_code' => form_error('branch_code'),
				'tbl_banks_id' => form_error('tbl_banks_id'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->bank_branch_model->add_bank_branch();

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
		$data = $this->bank_branch_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_bank_branch() {

		$json = array();

		// $this->form_validation->set_rules('id', 'bank_branch ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'bank_branch name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

		$this->form_validation->set_rules('branch_code', ucwords(str_replace('_', ' ', 'bank_branch code')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_banks_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'branch_code' => form_error('branch_code'),
				'tbl_banks_id' => form_error('tbl_banks_id'),
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->bank_branch_model->update_bank_branch();

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

	public function view_bank_branch() {
		$data['banks'] = $this->common_model->getAllRecordByArray('tbl_banks', array('status' => '1'));
		$data['page_title'] = 'View All bank_branch';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('bank_branch/view_bank_branch', $data);
		$this->load->view('templates/footer');
	}

	public function get_bank_branch() {

		$data = $row = array();

		// Fetch bank_branch's records
		$bank_branchData = $this->bank_branch_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($bank_branchData as $bank_branchInfo) {
			$i++;
			$status = ($bank_branchInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getRole = $this->global->getRecordById($bank_branchInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $bank_branchInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = '<i>Add by <strong>' . $getRole['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$getBanks = $this->global->getRecordById($bank_branchInfo->tbl_banks_id, $tbl_name = 'tbl_banks');

			$actionBtn = '<a href="javascript:void(0)" onclick="getData(' . "'" . $bank_branchInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $bank_branchInfo->name, $bank_branchInfo->branch_code, $getBanks['name'], $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bank_branch_model->countAll(),
			"recordsFiltered" => $this->bank_branch_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
