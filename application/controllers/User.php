<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();
	}

	public function dashboard() {
		if ($this->session->has_userdata('is_user_login') || $this->session->has_userdata('is_user_login')) {

			$data['page_title'] = 'Dashboard';
			$getuserRole = $this->common_model->getRecordById($_SESSION['tbl_role_id'], 'tbl_role');
			$data['description'] = 'Welcome ' . $_SESSION['name'];
			$data['rightDescription'] = $getuserRole['name'];

			//////////////////////////////////////month wise start////////////////////////////////////
			$query = $this->db->query("SELECT DATE_FORMAT(record_add_date,'%M %Y') as 8a FROM tbl_form_8a
			         GROUP BY month(record_add_date),year(record_add_date) ORDER BY record_add_date");
			$form_8a_years = (array_column($query->result(), '8a'));

			$query = $this->db->query("SELECT DATE_FORMAT(record_add_date,'%M %Y') as 8b FROM tbl_form_8b
			         GROUP BY month(record_add_date),year(record_add_date) ORDER BY record_add_date");
			$form_8b_years = (array_column($query->result(), '8b'));

			$query = $this->db->query("SELECT DATE_FORMAT(record_add_date,'%M %Y') as 8c FROM tbl_form_8c
			         GROUP BY month(record_add_date),year(record_add_date) ORDER BY record_add_date");
			$form_8c_years = (array_column($query->result(), '8c'));

			$query = $this->db->query("SELECT DATE_FORMAT(record_add_date,'%M %Y') as 8d FROM tbl_form_8d
			         GROUP BY month(record_add_date),year(record_add_date) ORDER BY record_add_date");
			$form_8d_years = (array_column($query->result(), '8d'));

			$form_years = array_values(array_unique(array_merge($form_8a_years, $form_8b_years, $form_8c_years, $form_8d_years), SORT_REGULAR));

			$data['form_years'] = json_encode($form_years, JSON_NUMERIC_CHECK);

			//////////////////////////////////////month wise form 8a start ///////////////////////////
			foreach ($form_years as $key => $form_yearsInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8a where DATE_FORMAT(record_add_date,'%M %Y')= '$form_yearsInfo' ");
				$form_8a[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($form_8a as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$form_8a = $singleArray;
			// change multidimensional array to single array

			$data['form_8a'] = json_encode($form_8a, JSON_NUMERIC_CHECK);
			//////////////////////////////////////month wise form 8a end /////////////////////////////

			//////////////////////////////////////month wise form 8b start ///////////////////////////
			foreach ($form_years as $key => $form_yearsInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8b where DATE_FORMAT(record_add_date,'%M %Y')= '$form_yearsInfo' ");
				$form_8b[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($form_8b as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$form_8b = $singleArray;
			// change multidimensional array to single array

			$data['form_8b'] = json_encode($form_8b, JSON_NUMERIC_CHECK);
			//////////////////////////////////////month wise form 8b end /////////////////////////////

			//////////////////////////////////////month wise form 8c start //////////////////////////
			foreach ($form_years as $key => $form_yearsInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8c where DATE_FORMAT(record_add_date,'%M %Y')= '$form_yearsInfo' ");
				$form_8c[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($form_8c as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$form_8c = $singleArray;
			// change multidimensional array to single array

			$data['form_8c'] = json_encode($form_8c, JSON_NUMERIC_CHECK);
			//////////////////////////////////////month wise form 8c end /////////////////////////////

			//////////////////////////////////////month wise form 8d start ///////////////////////////
			foreach ($form_years as $key => $form_yearsInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8d where DATE_FORMAT(record_add_date,'%M %Y')= '$form_yearsInfo' ");
				$form_8d[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($form_8d as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$form_8d = $singleArray;
			// change multidimensional array to single array

			$data['form_8d'] = json_encode($form_8d, JSON_NUMERIC_CHECK);
			//////////////////////////////////////month wise form 8d end /////////////////////////////

			//////////////////////////////////////month wise end /////////////////////////////////////

			//////////////////////////////////////District wise start/////////////////////////////////
			$query = $this->db->query("SELECT id, name FROM tbl_district
            GROUP BY name ORDER BY name asc");
			$data['district_form'] = json_encode(array_column($query->result(), 'name'), JSON_NUMERIC_CHECK);
			$district_wise = (array_column($query->result(), 'id'));
			//////////////////////////////////////District wise form 8a start ////////////////////////

			foreach ($district_wise as $key => $district_wiseInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8a where tbl_district_id= '$district_wiseInfo' ");
				$district_form_8a[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($district_form_8a as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$district_form_8a = $singleArray;
			// change multidimensional array to single array

			$data['district_form_8a'] = json_encode($district_form_8a, JSON_NUMERIC_CHECK);
			//////////////////////////////////////District wise form 8a end //////////////////////////

			//////////////////////////////////////District wise form 8b start ////////////////////////

			foreach ($district_wise as $key => $district_wiseInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8b where tbl_district_id= '$district_wiseInfo' ");
				$district_form_8b[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($district_form_8b as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$district_form_8b = $singleArray;
			// change multidimensional array to single array

			$data['district_form_8b'] = json_encode($district_form_8b, JSON_NUMERIC_CHECK);
			//////////////////////////////////////District wise form 8b end ////////////////////////

			//////////////////////////////////////District wise form 8c start ////////////////////////

			foreach ($district_wise as $key => $district_wiseInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8c where tbl_district_id= '$district_wiseInfo' ");
				$district_form_8c[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($district_form_8c as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$district_form_8c = $singleArray;
			// change multidimensional array to single array

			$data['district_form_8c'] = json_encode($district_form_8c, JSON_NUMERIC_CHECK);
			//////////////////////////////////////District wise form 8a end ////////////////////////

			//////////////////////////////////////District wise form 8d start ////////////////////////

			foreach ($district_wise as $key => $district_wiseInfo) {

				$query = $this->db->query("SELECT count(*) as count FROM tbl_form_8d where tbl_district_id= '$district_wiseInfo' ");
				$district_form_8d[] = array_column($query->result(), 'count');
			}
			// change multidimensional array to single array
			$singleArray = array();

			foreach ($district_form_8d as $key => $value) {
				$singleArray[$key] = $value[0];
			}
			$district_form_8d = $singleArray;
			// change multidimensional array to single array

			$data['district_form_8d'] = json_encode($district_form_8d, JSON_NUMERIC_CHECK);
			//////////////////////////////////////District wise form 8a end ////////////////////////

			//////////////////////////////////////District wise end //////// ////////////////////////

			////////////////////////////////////// Detail Application start//////////////////////////

			////////////////////////////////////// Detail Application form 8a start///////////////////

			$query = $this->db->query("SELECT count(id) as totalApplication FROM tbl_form_8a");
			$totalApplication = array_column($query->result(), 'totalApplication');

			$query = $this->db->query("SELECT count(id) as approved FROM tbl_form_8a where status='4'");
			$approved = array_column($query->result(), 'approved');

			$query = $this->db->query("SELECT count(id) as acceptDG FROM tbl_form_8a where status='1'");
			$acceptDG = array_column($query->result(), 'acceptDG');

			$query = $this->db->query("SELECT count(id) as pendingDG FROM tbl_form_8a where status='2'");
			$pendingDG = array_column($query->result(), 'pendingDG');

			$query = $this->db->query("SELECT count(id) as rejectDG FROM tbl_form_8a where status='0'");
			$rejectDG = array_column($query->result(), 'rejectDG');

			$query = $this->db->query("SELECT count(id) as approvedInspector FROM tbl_inspection where inspection_status='1' and tbl_name = 'tbl_form_8a'");
			$approvedInspector = array_column($query->result(), 'approvedInspector');

			$query = $this->db->query("SELECT count(id) as pendingInspector1 FROM tbl_inspection where inspection_status='4' and tbl_name = 'tbl_form_8a'");
			$pendingInspector1 = array_column($query->result(), 'pendingInspector1');

			$query = $this->db->query("SELECT count(id) as pendingInspector2 FROM tbl_inspection where inspection_status='2' and tbl_name = 'tbl_form_8a'");
			$pendingInspector2 = array_column($query->result(), 'pendingInspector2');
			$pendingInspector = array_map(function () {
				return array_sum(func_get_args());
			}, $pendingInspector1, $pendingInspector2);
			$query = $this->db->query("SELECT count(id) as rejectInspector FROM tbl_inspection where inspection_status='0' and tbl_name = 'tbl_form_8a'");
			$rejectInspector = array_column($query->result(), 'rejectInspector');

			$detail_application_form_8a = array_values(array_merge($totalApplication, $approved, $acceptDG, $pendingDG, $rejectDG, $approvedInspector, $pendingInspector, $rejectInspector));

			$data['detail_application_form_8a'] = json_encode($detail_application_form_8a, JSON_NUMERIC_CHECK);
			////////////////////////////////////// Detail Application form 8a end///////////////////

			////////////////////////////////////// Detail Application form 8b start///////////////////

			$query = $this->db->query("SELECT count(id) as totalApplication FROM tbl_form_8b");
			$totalApplication = array_column($query->result(), 'totalApplication');

			$query = $this->db->query("SELECT count(id) as approved FROM tbl_form_8b where status='4'");
			$approved = array_column($query->result(), 'approved');

			$query = $this->db->query("SELECT count(id) as acceptDG FROM tbl_form_8b where status='1'");
			$acceptDG = array_column($query->result(), 'acceptDG');

			$query = $this->db->query("SELECT count(id) as pendingDG FROM tbl_form_8b where status='2'");
			$pendingDG = array_column($query->result(), 'pendingDG');

			$query = $this->db->query("SELECT count(id) as rejectDG FROM tbl_form_8b where status='0'");
			$rejectDG = array_column($query->result(), 'rejectDG');

			$query = $this->db->query("SELECT count(id) as approvedInspector FROM tbl_inspection where inspection_status='1' and tbl_name = 'tbl_form_8b'");
			$approvedInspector = array_column($query->result(), 'approvedInspector');

			$query = $this->db->query("SELECT count(id) as pendingInspector1 FROM tbl_inspection where inspection_status='4' and tbl_name = 'tbl_form_8b'");
			$pendingInspector1 = array_column($query->result(), 'pendingInspector1');

			$query = $this->db->query("SELECT count(id) as pendingInspector2 FROM tbl_inspection where inspection_status='2' and tbl_name = 'tbl_form_8b'");
			$pendingInspector2 = array_column($query->result(), 'pendingInspector2');
			$pendingInspector = array_map(function () {
				return array_sum(func_get_args());
			}, $pendingInspector1, $pendingInspector2);
			$query = $this->db->query("SELECT count(id) as rejectInspector FROM tbl_inspection where inspection_status='0' and tbl_name = 'tbl_form_8b'");
			$rejectInspector = array_column($query->result(), 'rejectInspector');

			$detail_application_form_8b = array_values(array_merge($totalApplication, $approved, $acceptDG, $pendingDG, $rejectDG, $approvedInspector, $pendingInspector, $rejectInspector));

			$data['detail_application_form_8b'] = json_encode($detail_application_form_8b, JSON_NUMERIC_CHECK);
			////////////////////////////////////// Detail Application form 8b end///////////////////

			////////////////////////////////////// Detail Application form 8c start///////////////////

			$query = $this->db->query("SELECT count(id) as totalApplication FROM tbl_form_8c");
			$totalApplication = array_column($query->result(), 'totalApplication');

			$query = $this->db->query("SELECT count(id) as approved FROM tbl_form_8c where status='4'");
			$approved = array_column($query->result(), 'approved');

			$query = $this->db->query("SELECT count(id) as acceptDG FROM tbl_form_8c where status='1'");
			$acceptDG = array_column($query->result(), 'acceptDG');

			$query = $this->db->query("SELECT count(id) as pendingDG FROM tbl_form_8c where status='2'");
			$pendingDG = array_column($query->result(), 'pendingDG');

			$query = $this->db->query("SELECT count(id) as rejectDG FROM tbl_form_8c where status='0'");
			$rejectDG = array_column($query->result(), 'rejectDG');

			$query = $this->db->query("SELECT count(id) as approvedInspector FROM tbl_inspection where inspection_status='1' and tbl_name = 'tbl_form_8c'");
			$approvedInspector = array_column($query->result(), 'approvedInspector');

			$query = $this->db->query("SELECT count(id) as pendingInspector1 FROM tbl_inspection where inspection_status='4' and tbl_name = 'tbl_form_8c'");
			$pendingInspector1 = array_column($query->result(), 'pendingInspector1');

			$query = $this->db->query("SELECT count(id) as pendingInspector2 FROM tbl_inspection where inspection_status='2' and tbl_name = 'tbl_form_8c'");
			$pendingInspector2 = array_column($query->result(), 'pendingInspector2');
			$pendingInspector = array_map(function () {
				return array_sum(func_get_args());
			}, $pendingInspector1, $pendingInspector2);

			$query = $this->db->query("SELECT count(id) as rejectInspector FROM tbl_inspection where inspection_status='0' and tbl_name = 'tbl_form_8c'");
			$rejectInspector = array_column($query->result(), 'rejectInspector');

			$detail_application_form_8c = array_values(array_merge($totalApplication, $approved, $acceptDG, $pendingDG, $rejectDG, $approvedInspector, $pendingInspector, $rejectInspector));

			$data['detail_application_form_8c'] = json_encode($detail_application_form_8c, JSON_NUMERIC_CHECK);
			////////////////////////////////////// Detail Application form 8c end///////////////////

			////////////////////////////////////// Detail Application form 8d start///////////////////

			$query = $this->db->query("SELECT count(id) as totalApplication FROM tbl_form_8d");
			$totalApplication = array_column($query->result(), 'totalApplication');

			$query = $this->db->query("SELECT count(id) as approved FROM tbl_form_8d where status='4'");
			$approved = array_column($query->result(), 'approved');

			$query = $this->db->query("SELECT count(id) as acceptDG FROM tbl_form_8d where status='1'");
			$acceptDG = array_column($query->result(), 'acceptDG');

			$query = $this->db->query("SELECT count(id) as pendingDG FROM tbl_form_8d where status='2'");
			$pendingDG = array_column($query->result(), 'pendingDG');

			$query = $this->db->query("SELECT count(id) as rejectDG FROM tbl_form_8d where status='0'");
			$rejectDG = array_column($query->result(), 'rejectDG');

			$query = $this->db->query("SELECT count(id) as approvedInspector FROM tbl_inspection where inspection_status='1' and tbl_name = 'tbl_form_8d'");
			$approvedInspector = array_column($query->result(), 'approvedInspector');

			$query = $this->db->query("SELECT count(id) as pendingInspector1 FROM tbl_inspection where inspection_status='4' and tbl_name = 'tbl_form_8d'");
			$pendingInspector1 = array_column($query->result(), 'pendingInspector1');

			$query = $this->db->query("SELECT count(id) as pendingInspector2 FROM tbl_inspection where inspection_status='2' and tbl_name = 'tbl_form_8d'");
			$pendingInspector2 = array_column($query->result(), 'pendingInspector2');
			$pendingInspector = array_map(function () {
				return array_sum(func_get_args());
			}, $pendingInspector1, $pendingInspector2);

			$query = $this->db->query("SELECT count(id) as rejectInspector FROM tbl_inspection where inspection_status='0' and tbl_name = 'tbl_form_8d'");
			$rejectInspector = array_column($query->result(), 'rejectInspector');

			$detail_application_form_8d = array_values(array_merge($totalApplication, $approved, $acceptDG, $pendingDG, $rejectDG, $approvedInspector, $pendingInspector, $rejectInspector));

			$data['detail_application_form_8d'] = json_encode($detail_application_form_8d, JSON_NUMERIC_CHECK);
			////////////////////////////////////// Detail Application form 8d end///////////////////
			/////////////////////////////////////////////// Detail application end////////////////////
			$this->load->view('templates/header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('templates/footer');
		} else {
			redirect(base_url('auth/logout'));
		}
	}

	// add user
	public function add_user() {
		if ($_SESSION['tbl_role_id'] != '1') {
			$this->session->sess_destroy();
			redirect('user', 'refresh');
		}
		$data['page_title'] = 'Add New User Information';
		$data['description'] = '...';
		$data['role'] = $this->common_model->getAllRecordByArray('tbl_role', array('status' => '1'));
		$data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));
		if ($this->input->post('submit')) {
			//login info
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists|min_length[3]|max_length[20]|xss_clean|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'xss_clean|trim|matches[password]');
			$this->form_validation->set_rules('tbl_role_id', 'user Role Selection', 'required|xss_clean|trim');
			$this->form_validation->set_rules('tbl_district_id', 'Subject Selection', 'required|xss_clean|trim');
			//personal info

			$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'name')), 'required|xss_clean|trim|min_length[3]|max_length[40]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists|xss_clean|valid_email|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('user/add_user', $data);
				$this->load->view('templates/footer');
			} else {
				$enc_pwd = safe_encode($this->input->post('password'));
				// $enc_pwd = $this->input->post('password');
				// to model
				$this->user_model->add_user($enc_pwd);
				// set session message
				$this->session->set_flashdata('add', '!');
				redirect(base_url('view_user'));
			}
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('user/add_user');
			$this->load->view('templates/footer');
		}
	}
	public function edit_user($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {
			$id = safe_decode($id);

			if (!empty($this->input->post('current_password'))) {

				$this->form_validation->set_rules('current_password', 'Current Password', 'required|xss_clean|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

				$this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

				$this->form_validation->set_rules('c_new_password', 'Confirm New Password', 'required|xss_clean|trim|matches[new_password]|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			}

			//login info
			// $this->form_validation->set_rules('username','Username','required|callback_check_username_exists|xss_clean|trim|alpha_numeric');
			if ($_SESSION['tbl_role_id'] == '1') {
				$this->form_validation->set_rules('tbl_role_id', 'User Role Selection', 'required|xss_clean|trim');
				$this->form_validation->set_rules('tbl_district_id', 'District Selection', 'required|xss_clean|trim');
				$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
				// $this->form_validation->set_rules('approve_status', 'Approve Status', 'required|xss_clean');
			}

			$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'full name')), 'required|xss_clean|trim|min_length[3]|max_length[40]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['all'] = $this->common_model->getRecordById(safe_decode($this->input->post('id')), $tbl_name = 'tbl_user');

				$data['role'] = $this->common_model->getAllRecordByArray('tbl_role', array('status' => '1'));
				$data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));

				$data['page_title'] = 'Edit User Information';
				$data['description'] = '...';
				if (empty($data['all'])) {
					show_404();
				}
				$this->load->view('templates/header', $data);
				$this->load->view('user/edit_user', $data);
				$this->load->view('templates/footer');
			} else {
				// first check the current pwd with db pwd ... then change it with new pwd
				$current_pwd = $this->input->post('current_password');
				$userDetail = $this->global->getRecordById(safe_decode($this->input->post('id')), 'tbl_user');
				$db_pwd = safe_decode($userDetail['password']);
				// $db_pwd = $userDetail['password'];
				if (!empty($current_pwd)) {
					if ($current_pwd == $db_pwd) {
						$enc_pwd = safe_encode($this->input->post('new_password'));
						// $enc_pwd = $this->input->post('new_password');
						$this->session->set_flashdata('pwd', '!');
					} else {
						$enc_pwd = $userDetail['password'];
						$this->session->set_flashdata('pwd_error', '!');
					}
				} else {
					$enc_pwd = $userDetail['password'];
				}
				// to model
				$this->user_model->update_user($enc_pwd);
				// set session message
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_user'));
			}
		} else {
			// echo 'user= '.$_SESSION['user_id'].' .... $id= '.$id.'<br>';
			// echo 'tbl_role_id= '.$_SESSION['tbl_role_id'];
			if ($_SESSION['tbl_role_id'] != '1') {
				if ($_SESSION['user_id'] != $id) {
					$this->session->sess_destroy();
					redirect('user', 'refresh');
				}
			}

			$data['all'] = $this->common_model->getRecordById($id, $tbl_name = 'tbl_user');
			$data['role'] = $this->common_model->getAllRecordByArray('tbl_role', array('status' => '1'));
			$data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));
			$data['page_title'] = 'Edit user Information';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('user/edit_user', $data);
			$this->load->view('templates/footer');
		}
	}
	// view user detail
	public function view_user() {
		if (empty($_SESSION['tbl_role_id'])) {
			$this->session->sess_destroy();
			redirect(base_url('login'), 'refresh');
		}

		$data['view_user'] = $this->user_model->view_user();
		$data['page_title'] = 'View Users';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('user/view_user', $data);
		$this->load->view('templates/footer');
	}
	public function check_username_exists($username) {
		$this->form_validation->set_message('check_username_exists', 'This username is already Exists, Please Choose another');
		if ($this->user_model->check_username_exists($username)) {
			return true;
		} else {
			return false;
		}
	}
	public function check_email_exists($email) {
		$this->form_validation->set_message('check_email_exists', 'This email is already in use, Please Choose another');
		if ($this->user_model->check_email_exists($email)) {
			return true;
		} else {
			return false;
		}
	}
}
?>