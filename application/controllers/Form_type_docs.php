<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_type_docs extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_form_type_docs() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'form_type_docs name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('tbl_form_type_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'tbl_form_type_id' => form_error('tbl_form_type_id'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->form_type_docs_model->add_form_type_docs();

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
		$data = $this->form_type_docs_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_form_type_docs() {

		$json = array();

		// $this->form_validation->set_rules('id', 'form_type_docs ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'form_type_docs name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_form_type_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'tbl_form_type_id' => form_error('tbl_form_type_id'),
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->form_type_docs_model->update_form_type_docs();

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

	public function view_form_type_docs() {
		$data['form_type'] = $this->common_model->getAllRecordByArray('tbl_form_type', array('status' => '1'));
		$data['page_title'] = 'View All form_type_docs';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('form_type_docs/view_form_type_docs', $data);
		$this->load->view('templates/footer');
	}

	public function get_form_type_docs() {

		$data = $row = array();

		// Fetch form_type_docs's records
		$form_type_docsData = $this->form_type_docs_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($form_type_docsData as $form_type_docsInfo) {
			$i++;
			$status = ($form_type_docsInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($form_type_docsInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $form_type_docsInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = '<i>Add by <strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$getFromType = $this->global->getRecordById($form_type_docsInfo->tbl_form_type_id, $tbl_name = 'tbl_form_type');

			$actionBtn =
			'<a href="javascript:void(0)" onclick="getData(' . "'" . $form_type_docsInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $form_type_docsInfo->name, $getFromType['name'], $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->form_type_docs_model->countAll(),
			"recordsFiltered" => $this->form_type_docs_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
