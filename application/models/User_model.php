<?php

class User_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function user_login($data) {
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$query = $this->db->get_where('tbl_user', array('username' => $data['username'], 'status' => '1'));
		if ($query->num_rows() == 0) {
			return false;
		} else {
			// return $result = $query->row_array();
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
			// $dbpwd = $result['password'];
			// echo $dbpwd=$result['password'];
			$dbpwd = safe_decode($result['password']);
			$pwd = $data['password'];
			// $validPassword = password_verify($pwd, $result['password']);
			// if($validPassword){
			if ($pwd == $dbpwd) {
				return $result = $query->row_array();
			}
		}
	}

	public function user_recover($token, $data) {
		//XSS prevention
		$data = $this->security->xss_clean($data);
		$query = $this->db->get_where('tbl_user', array('email' => $data['email'], 'status' => '1'));
		// $query = $this->db->get_where('tbl_admin', array('username' => $data['username'],'password' => $data['password'],'status' => '1'));
		if ($query->num_rows() == 0) {
			return false;
		} else {
			$result = $query->row_array();
			$dbEmail = $result['email'];
			$email = $data['email'];
			if ($dbEmail == $email) {
				$data2 = array(
					'forgot_password_token' => $token,
				);
				//updation in db
				$this->db->where('email', $email);
				$this->db->update('tbl_user', $data2);
				return $result = $query->row_array();
			}
		}
	}

	public function user_change_password($data) {
		//XSS prevention
		$data = $this->security->xss_clean($data);
		$getUserDetail = $this->common_model->getRecordByArray('tbl_user', array('email' => $data['email'], 'status' => '1', 'forgot_password_token' => $data['token']));

		if ((empty($getUserDetail)) || count($getUserDetail) == '0') {
			$data1 = array(
				'forgot_password_token' => null,
			);
			//updation in db
			$this->db->where('email', $data['email']);
			$this->db->where('forgot_password_token', $data['token']);
			$this->db->update('tbl_user', $data1);
			return false;
		} else {

			$enc_pwd = safe_encode($data['password']);
			// $enc_pwd = $data['password'];

			$data2 = array(
				'password' => $enc_pwd,
				'forgot_password_token' => null,
			);
			//updation in db
			$this->db->where('email', $data['email']);
			$this->db->where('forgot_password_token', $data['token']);
			$this->db->update('tbl_user', $data2);

			return true;}
	}

	//activate account
	function verifyEmail($key) {
		$key = safe_decode($key);

		$getUserDetail = $this->common_model->getRecordByArray('tbl_user', array('email' => $key, 'status' => '0'));
		if ((empty($getUserDetail)) || count($getUserDetail) == '0') {
			return false;
		} else {

			$data = array('status' => 1);
			$this->db->where('email', $key);
			$result = $this->db->update('tbl_user', $data); //update status as 1 to make active user
			return true;
		}

	}

	public function registration($enc_pwd) {

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $enc_pwd,
			'tbl_role_id' => '5',
			'tbl_district_id' => $this->input->post('tbl_district_id'),
			'status' => '0',

			'name' => ucwords($this->input->post('name')),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			// 'approve_by' => '0',
			// 'approve_status' => '0',

			'record_add_by' => '0',
			'record_add_date' => date('Y-m-d'),
		);

		//XSS prevention
		$data = $this->security->xss_clean($data);

		//insertion in db
		return $this->db->insert('tbl_user', $data);
	}

	public function add_user($enc_pwd) {

		// $dob = strtotime($this->input->post('dob'));
		// $dob = date('Y-m-d', $dob);

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $enc_pwd,
			'tbl_role_id' => $this->input->post('tbl_role_id'),
			'tbl_district_id' => $this->input->post('tbl_district_id'),
			'status' => $this->input->post('status'),

			'name' => ucwords($this->input->post('name')),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),

			'approve_by' => $_SESSION['user_id'],
			// 'approve_status' => $this->input->post('approve_status'),
			// 'approve_status' => '1',

			'record_add_by' => $_SESSION['user_id'],
			'record_add_date' => date('Y-m-d'),
		);

		//XSS prevention
		$data = $this->security->xss_clean($data);

		//insertion in db
		return $this->db->insert('tbl_user', $data);
	}

	public function update_user($enc_pwd) {

		$data1 = array(
			// 'username' => $this->input->post('username'),
			'password' => $enc_pwd,

			'name' => ucwords($this->input->post('name')),
			'gender' => $this->input->post('gender'),

		);

		if ($_SESSION['tbl_role_id'] == '1') {

			$data2 = array(

				'tbl_role_id' => $this->input->post('tbl_role_id'),
				'tbl_district_id' => $this->input->post('tbl_district_id'),
				'status' => $this->input->post('status'),
			);
		}

		// if ($_SESSION['tbl_role_id'] == '1' && !empty($this->input->post('approve_status'))) {

		// 	$data3 = array(

		// 		'approve_by' => $_SESSION['user_id'],
		// 		'approve_status' => $this->input->post('approve_status'),
		// 	);
		// }

		$data = array();

		if (!empty($data1)) {
			$data = array_merge($data, $data1);
		}

		if (!empty($data2)) {
			$data = array_merge($data, $data2);
		}
		// if (!empty($data3)) {
		// 	$data = array_merge($data, $data3);
		// }

		$data = $this->security->xss_clean($data);

		//updation in db
		$this->db->where('id', safe_decode($this->input->post('id')));
		return $this->db->update('tbl_user', $data);
	}

	public function view_user() {

		if ($_SESSION['tbl_role_id'] > '1') {
			$query = $this->db->get_where('tbl_user', array('id' => $_SESSION['user_id']));
			return $query->result_array();

		} elseif ($_SESSION['tbl_role_id'] == '1') {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}

	}

	public function check_username_exists($username) {
		$query = $this->db->get_where('tbl_user', array('username' => $username));
		if (empty($query->row_array())) {
			return true;
		} else {return false;}

	}
	public function check_email_exists($email) {
		$query = $this->db->get_where('tbl_user', array('email' => $email));
		if (empty($query->row_array())) {
			return true;
		} else {return false;}

	}

}
?>