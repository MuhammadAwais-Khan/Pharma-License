<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proprietor extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();
		// $this->load->library('img_upload');

		// if ($_SESSION['tbl_proprietor_id'] != '1') {
		// 	$this->session->sess_destroy();
		// 	redirect('admin', 'refresh');
		// }
	}

	public function show_proprietor($id) {
		$id = safe_decode($id);
		$data['all'] = $this->common_model->getRecordById($id, $tbl_name = 'tbl_proprietor');
		$data['page_title'] = 'proprietor Information';
		$data['description'] = '...';
		if (empty($data['all'])) {
			show_404();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('proprietor/show_proprietor', $data);
		$this->load->view('templates/footer');
	}

	public function edit_proprietor($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'proprietor name')), 'required|xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('cnic_no', ucwords(str_replace('_', ' ', 'cnic_no')), 'required|xss_clean|trim|min_length[15]|max_length[15]');
			$this->form_validation->set_rules('gender', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('mobile_no', ucwords(str_replace('_', ' ', 'mobile_no')), 'required|xss_clean|trim|min_length[12]|max_length[12]');
			$this->form_validation->set_rules('home_address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('business_name', ucwords(str_replace('_', ' ', ' business_name')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('business_address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('proprietor_name[]', ucwords(str_replace('_', ' ', 'proprietor_name')), 'xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('proprietor_cnic_no[]', ucwords(str_replace('_', ' ', 'proprietor_cnic_no')), 'xss_clean|trim|min_length[15]|max_length[15]');
			$this->form_validation->set_rules('proprietor_mobile_no[]', ucwords(str_replace('_', ' ', 'proprietor_mobile_no')), 'xss_clean|trim|min_length[12]|max_length[12]');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['all'] = $this->common_model->getRecordById(safe_decode($this->input->post('id')), $tbl_name = 'tbl_proprietor');
				$data['page_title'] = 'Edit proprietor Information';
				$data['description'] = '...';
				if (empty($data['all'])) {
					show_404();
				}
				$this->load->view('templates/header', $data);
				$this->load->view('proprietor/edit_proprietor', $data);
				$this->load->view('templates/footer');
			} else {

				// to model
				$this->proprietor_model->update_proprietor();
				// set session message
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_proprietor'));
			}
		} else {

			$data['all'] = $this->common_model->getRecordById($id, $tbl_name = 'tbl_proprietor');
			$data['page_title'] = 'Edit proprietor Information';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('proprietor/edit_proprietor', $data);
			$this->load->view('templates/footer');
		}
	}
	public function add_proprietor() {

		$data['page_title'] = 'Add New proprietor Information';
		$data['description'] = '...';
		$data['role'] = $this->common_model->getAllRecordByArray('tbl_role', array('status' => '1'));
		$data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));
		if ($this->input->post('submit')) {
			//login info
			$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'proprietor name')), 'required|xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('cnic_no', ucwords(str_replace('_', ' ', 'cnic_no')), 'required|xss_clean|trim|min_length[15]|max_length[15]');
			$this->form_validation->set_rules('gender', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('mobile_no', ucwords(str_replace('_', ' ', 'mobile_no')), 'required|xss_clean|trim|min_length[12]|max_length[12]');
			$this->form_validation->set_rules('home_address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('business_name', ucwords(str_replace('_', ' ', ' business_name')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('business_address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('proprietor_name[]', ucwords(str_replace('_', ' ', 'proprietor_name')), 'xss_clean|trim|min_length[1]|max_length[35]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('proprietor_cnic_no[]', ucwords(str_replace('_', ' ', 'proprietor_cnic_no')), 'xss_clean|trim|min_length[15]|max_length[15]');
			$this->form_validation->set_rules('proprietor_mobile_no[]', ucwords(str_replace('_', ' ', 'proprietor_mobile_no')), 'xss_clean|trim|min_length[12]|max_length[12]');

			// $this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('proprietor/add_proprietor', $data);
				$this->load->view('templates/footer');
			} else {
				// to model
				$this->proprietor_model->add_proprietor();
				// set session message
				$this->session->set_flashdata('add', '!');
				redirect(base_url('view_proprietor'));
			}
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('proprietor/add_proprietor');
			$this->load->view('templates/footer');
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////

	public function getData($id) {
		$data = $this->proprietor_model->getRecordById($id);
		echo json_encode($data);
	}

	public function getShowData($id) {
		$data = $this->proprietor_model->getShowData($id);
		echo json_encode($data);
	}

	public function view_proprietor() {

		$data['page_title'] = 'View All proprietors';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('proprietor/view_proprietor', $data);
		$this->load->view('templates/footer');
	}

	public function get_proprietor() {

		$data = $row = array();

		// Fetch proprietor's records
		$proprietorData = $this->proprietor_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($proprietorData as $proprietorInfo) {
			$i++;
			// $status = ($proprietorInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($proprietorInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $proprietorInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$actionBtn = '
                <div class="btn-group btn-sm">
                  <!-- <button type="button" class="btn btn-default  btn-sm">Action</button> -->
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="' . site_url('proprietor/show_proprietor/' . safe_encode($proprietorInfo->id)) . '">
                      <button type="button" class="btn btn-sm btn-xs btn-success"><i class="fa fa-info-circle"></i> Detail</button>
                      </a></li>
                    <li><a href="' . site_url('proprietor/edit_proprietor/' . safe_encode($proprietorInfo->id)) . '">
                      <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</button>
                      </a></li>
                  </ul>
                </div>';

			$data[] = array($i, $proprietorInfo->business_name, $proprietorInfo->name, $proprietorInfo->cnic_no, $proprietorInfo->business_address, $add_by_date, $actionBtn);

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->proprietor_model->countAll(),
				"recordsFiltered" => $this->proprietor_model->countFiltered($_POST),
				"data" => $data,
			);

		} // foreach end

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
