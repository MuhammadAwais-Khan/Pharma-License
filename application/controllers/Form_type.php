<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_type extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '1')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_form_type() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'form_type name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|is_unique[tbl_form_type.name]');

		$this->form_validation->set_rules('rules', ucwords(str_replace('_', ' ', 'Rules')), 'required|xss_clean|trim');

		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'rules' => form_error('rules'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->form_type_model->add_form_type();

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
		$data = $this->form_type_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_form_type() {

		$json = array();

		// $this->form_validation->set_rules('id', 'form_type ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'form_type name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('rules', ucwords(str_replace('_', ' ', 'Rules')), 'required|xss_clean|trim');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'name' => form_error('name'),
				'rules' => form_error('rules'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->form_type_model->update_form_type();

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

	public function view_form_type() {

		$data['page_title'] = 'View All form_types';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('form_type/view_form_type', $data);
		$this->load->view('templates/footer');
	}

	public function get_form_type() {

		$data = $row = array();

		// Fetch form_type's records
		$form_typeData = $this->form_type_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($form_typeData as $form_typeInfo) {
			$i++;
			$status = ($form_typeInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($form_typeInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $form_typeInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '<a href="javascript:void(0)" onclick="getShowData(' . "'" . $form_typeInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-success"><i class="fa fa-info-circle"></i></button>
                      </a>' .
			'<a href="javascript:void(0)" onclick="getData(' . "'" . $form_typeInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $form_typeInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->form_type_model->countAll(),
			"recordsFiltered" => $this->form_type_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
