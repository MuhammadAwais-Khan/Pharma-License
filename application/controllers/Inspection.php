<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inspection extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '3')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}

	public function fetchDataFormTypeDoc($tbl_form_type_id) {
		$data = $this->apply_model->fetchDataFormTypeDoc($tbl_form_type_id);
		echo json_encode($data);
	}

	public function fetchDocFromApplicationDoc($tblFormTypeID, $tblFormApplyID) {
		$data = $this->apply_model->fetchDocFromApplicationDoc($tblFormTypeID, $tblFormApplyID);
		echo json_encode($data);
	}

	public function edit_inspection($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('inspection_date', ucwords(str_replace('_', ' ', 'inspection_date')), 'required|xss_clean|trim|min_length[3]');
			$this->form_validation->set_rules('inspection_reason', ucwords(str_replace('_', ' ', 'inspection_reason')), 'required|xss_clean|trim|min_length[3]');
			$this->form_validation->set_rules('license_validity', ucwords(str_replace('_', ' ', 'license_validity')), 'xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('proprieter_qualified_present', 'Selection', 'required|xss_clean');

			$this->form_validation->set_rules('sign_board', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('area', ucwords(str_replace('_', ' ', 'area')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('front_area', ucwords(str_replace('_', ' ', 'front_area')), 'required|xss_clean|trim|min_length[3]');
			$this->form_validation->set_rules('protected', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('thermometer', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('cool_chin', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('adequate_light', 'Selection', 'required|xss_clean');

			$this->form_validation->set_rules('painted', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('almiras_wooden', 'Selection', 'xss_clean');
			$this->form_validation->set_rules('almiras_glass', 'Selection', 'xss_clean');
			$this->form_validation->set_rules('almiras_metal', 'Selection', 'xss_clean');

			$this->form_validation->set_rules('inspection_status', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('inspection_remarks', ucwords(str_replace('_', ' ', 'inspection_remarks')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['inspector'] = $this->common_model->getAllRecordByArray('tbl_user', array('tbl_role_id' => '3', 'status' => '1'));
				$data['all'] = $this->common_model->getRecordById($this->input->post('id'), 'tbl_application');
				$data['page_title'] = 'inspector section';
				$data['description'] = '...';

				$this->load->view('templates/header', $data);
				$this->load->view('apply/edit_dg');
				$this->load->view('templates/footer');
			} else {

				$this->inspection_model->update_inspection();
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_inspection'));
			}
		} else {
			$data['all'] = $this->common_model->getRecordById($id, 'tbl_inspection');
			$data['page_title'] = 'inspector section';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('inspection/edit_inspection');
			$this->load->view('templates/footer');
		}
	}

	public function getData($id) {
		$data = $this->apply_model->getRecordById($id);
		echo json_encode($data);
	}

	public function view_inspection() {
		// $data['department'] = $this->common_model->getAllRecordByArray('tbl_department', array('status' => '1'));
		// $data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));
		// $data['post'] = $this->common_model->getAllRecordByArray('tbl_post', array('status' => '1'));
		$data['page_title'] = 'DG Approved Applications';
		// $data['page_title'] = 'View inspection info';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('inspection/view_inspection', $data);
		$this->load->view('templates/footer');
	}

	public function get_inspection() {

		$data = $row = array();

		// Fetch emp info's records
		$inspectionData = $this->inspection_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($inspectionData as $inspectionInfo) {
			// if ($inspectionInfo->inspection_status != '1') {
			$i++;
			if ($inspectionInfo->inspection_status == 2) {$status1 = '<span class="label label-primary">Pending/ Inprocess</span>';} else if ($inspectionInfo->inspection_status == 1) {$status1 = '<span class="label label-success">Approved/Inspected</span>';} else if ($inspectionInfo->inspection_status == 0) {$status1 = '<span class="label label-danger">Rejected</span>';} else if ($inspectionInfo->inspection_status == 4) {$status1 = '<span class="label label-danger">Not Inspected</span>';}

			if ($inspectionInfo->inspection_date) {

				$status2 = 'Inspected on ' . date("d-m-Y", strtotime($inspectionInfo->inspection_date));
			}
			$status = $status1 . '<br>' . $status2;

			// $getUser = $this->global->getRecordById($inspectionInfo->record_add_by, $tbl_name = 'tbl_admin');
			// $recordAddDate = date("d-M-Y", strtotime($inspectionInfo->record_add_date));

			// $add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			// $getApplication = $this->global->getRecordById($inspectionInfo->tbl_name_id, $tbl_name = 'tbl_application');

			$getApplication = $this->global->getRecordById($inspectionInfo->tbl_name_id, $tbl_name = $inspectionInfo->tbl_name);

			// var_dump($getApplication);exit;

			$getFormType = $this->global->getRecordById($getApplication['tbl_form_type_id'], $tbl_name = 'tbl_form_type');

			$getDistrict = $this->global->getRecordById($getApplication['tbl_district_id'], $tbl_name = 'tbl_district');

			$getProprietor = $this->global->getRecordById($getApplication['tbl_proprietor_id'], $tbl_name = 'tbl_proprietor');

			$getPharmacist = $this->global->getRecordById($getApplication['tbl_pharmacist_id'], $tbl_name = 'tbl_pharmacist');

			// $getDates = $this->global->getRecordByArray($tbl_name = 'tbl_application_renewel', array('tbl_inspection_id' => $inspectionInfo->id));

			// $dob = date('d-m-Y', strtotime($inspectionInfo->dob));

			if ($inspectionInfo->is_inspection == '1') {
				$inspectionBtn = '<a href="' . site_url('inspection/edit_inspection/' . safe_encode($inspectionInfo->id)) . '">
                      <button type="button" class="btn btn-sm btn-xs btn-info"><i class="fa fa-edit"></i> Inspect Now</button>
                      </a>';
			} else { $inspectionBtn = "";}

			if ($inspectionInfo->is_print == '1') {
				$printBtn = '<a href="' . site_url('common/print_license/' . safe_encode($inspectionInfo->tbl_name) . '/' . safe_encode($inspectionInfo->tbl_name_id) . '') . '">
                      <button type="button" class="btn btn-sm btn-xs btn-success"><i class="fa fa-print"></i> Print License</button>
                      </a>';
			} else { $printBtn = "";}

			// if ($inspectionInfo->is_dates == '1') {
			// 	$datesBtn = '<a href="' . site_url('inspection/edit_dates/' . $getDates['id']) . '">
			//                    <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> License Validity Dates</button>
			//                    </a>';
			// } else { $datesBtn = "";}

			$actionBtn = $inspectionBtn . ' ' . $printBtn; // . ' ' . $datesBtn;

			$data[] = array($i, $getFormType['name'] . ' (' . $inspectionInfo->license_type . ')', $getDistrict['name'], $getProprietor['name'], $getPharmacist['name'], $status, $actionBtn);
			// }
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->inspection_model->countAll(),
			"recordsFiltered" => $this->inspection_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
