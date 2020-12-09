<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacist_category extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '4')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}
	public function add_pharmacist_category() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'category name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|is_unique[tbl_pharmacist_category.name]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$result = $this->pharmacist_category_model->add_pharmacist_category();

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
		$data = $this->pharmacist_category_model->getRecordById($id);
		echo json_encode($data);
	}

	public function update_pharmacist_category() {

		$json = array();

		// $this->form_validation->set_rules('id', 'pharmacist_category ID', 'required|xss_clean');
		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'category name')), 'required|xss_clean|trim|min_length[1]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
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
			$result = $this->pharmacist_category_model->update_pharmacist_category();

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

	public function view_pharmacist_category() {

		$data['page_title'] = 'View All categories';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('pharmacist_category/view_pharmacist_category', $data);
		$this->load->view('templates/footer');
	}

	public function get_pharmacist_category() {

		$data = $row = array();

		// Fetch pharmacist_category's records
		$pharmacist_categoryData = $this->pharmacist_category_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($pharmacist_categoryData as $pharmacist_categoryInfo) {
			$i++;
			$status = ($pharmacist_categoryInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($pharmacist_categoryInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $pharmacist_categoryInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '<a href="javascript:void(0)" onclick="getData(' . "'" . $pharmacist_categoryInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>';
			$data[] = array($i, $pharmacist_categoryInfo->name, $status, $add_by_date, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pharmacist_category_model->countAll(),
			"recordsFiltered" => $this->pharmacist_category_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
