<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Model extends CI_Model {
	// General select query to select * data from table without any condition
	public function fetch_all($table) {
		$query = $this->db->query("select * from $table");
		if (!$query) {
			$response['message'] = 'error in sql query';
			$response['success'] = '201';
			echo json_encode($response);exit();
		} else {
			return $query->result_array();
		}

	}
	public function num_rows($query) {
		// echo $query;
		$query = $this->db->query($query);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
// Select general query
	public function select_fields_where_like_join($tbl = '', $data = '', $joins = '', $where = '', $single = FALSE, $field = '', $value = '', $group_by = '', $order_by = '', $limit = '', $page = '', $where_in_col = '', $where_in_array = '') {

		if (is_array($data) and isset($data[1])) {
			$this->db->select($data[0], $data[1]);
		} else {
			$this->db->select($data);
		}

		$this->db->from($tbl);
		if ($joins != '') {
			foreach ($joins as $k => $v) {
				$this->db->join($v['table'], $v['condition'], $v['type']);
			}
		}

		if ($value !== '') {
			// $this->db->like('LOWER(' . $field . ')', strtolower($value));
			// $this->db->or_like($value);
			$this->db->like($value);
		}

		if ($where != '') {
			$this->db->where($where);
		}

		if ($where_in_col != '' && $where_in_array != '') {
			$this->db->where_in($where_in_col, $where_in_array);
		}

		if ($group_by != '') {
			$this->db->group_by($group_by);
		}
		if ($order_by != '') {
			if (is_array($order_by)) {
				$this->db->order_by($order_by[0], $order_by[1]);
			} else {
				$this->db->order_by($order_by);
			}
		}
		if ($limit != '') {
			// if(is_array($limit)){
			//     $this->db->limit($limit[0],$limit[1]);
			// }else{
			//     $this->db->limit($limit);
			// }
			$this->db->limit($limit, $page);
		}
		$query = $this->db->get();
		//print_r($this->db->last_query());//exit();
		if ($query) {
			if ($single == TRUE) {
				return $query->row();
			} else {
				return $query->result();
			}
		} else {
			return FALSE;
		}
	}

	public function custom_query($query) {
		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function read_conditionally($table, $id, $col) {
		$query = $this->db->query("SELECT * FROM $table WHERE $col = '$id' ");
		return $query->result_array();
	}

	public function insert($table, $data) {
		if ($this->db->insert($table, $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function insert_last_id($table, $data) {
		if ($this->db->insert($table, $data)) {
			//print_r($this->db->last_query());//exit();
			//print_r($this->db->error());
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update_query($tbl, $where, $data) {
		$this->db->where($where);
		$this->db->update($tbl, $data);
		// print_r($this->db->last_query());  exit();
		$affectedRows = $this->db->affected_rows();
		if ($affectedRows) {
			return true;
		} else {
			return $this->db->error();
		}
	}

	// public function delete_rec($table, $id, $col) {
	// 	$result = $this->db->query("delete from $table where $col = $id");
	// 	if ($result) {
	// 		return TRUE;
	// 	} else {
	// 		return FALSE;
	// 	}
	// }

	public function check_email_exists($email) {
		$this->db->select('id')->from('tbl_user');
		$this->db->where('email', $email);

		$result = $this->db->get()->row();

		if ($result) {
			return $result;
		} else {
			return 0;
		}

	}

	public function insert_user($data) {
		$this->db->insert('tbl_user', $data);
		$result = $this->db->insert_id();

		if ($result) {
			return $result;
		} else {
			return 0;
		}

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
				// return $result = $query->row_array();
				return $result = $query->row();
			}
		}
	}

	public function getRecordById($id, $tbl_name) {
		$query = $this->db->get_where($tbl_name, array('id' => $id));
		return $query->row_array();
	}

	public function update_inspections($shop_img) {

		if (!empty($this->input->post('license_validity'))) {
			$license_validity = date('Y-m-d', strtotime($this->input->post('license_validity')));
		}
		$inspection_date = date('Y-m-d', strtotime($this->input->post('inspection_date')));

		$data = array(
			'inspection_date' => $inspection_date,
			'inspection_reason' => $this->input->post('inspection_reason'),
			'license_validity' => $license_validity,
			'proprieter_qualified_present' => $this->input->post('proprieter_qualified_present'),
			'sign_board' => $this->input->post('sign_board'),
			'area' => $this->input->post('area'),
			'front_area' => $this->input->post('front_area'),
			'protected' => $this->input->post('protected'),
			'thermometer' => $this->input->post('thermometer'),
			'cool_chin' => $this->input->post('cool_chin'),
			'adequate_light' => $this->input->post('adequate_light'),
			'painted' => $this->input->post('painted'),
			'almiras_wooden' => $this->input->post('almiras_wooden'),
			'almiras_glass' => $this->input->post('almiras_glass'),
			'almiras_metal' => $this->input->post('almiras_metal'),

			'inspection_remarks' => $this->input->post('inspection_remarks'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'inspection_status' => $this->input->post('inspection_status'),
			// 'inspect_by' => $_SESSION['user_id'],
			'inspect_by' => $this->input->post('user_id'),

		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('tbl_inspection', $data);

		$getInspection = $this->api_model->getRecordById($this->input->post('id'), $tbl_name = 'tbl_inspection');

		if ($result == true) {
			// first get form type and the get proprieter detail and update  latitude and logitude
			// getFormType is for proprietor id
			$getFormType = $this->api_model->getRecordById($getInspection['tbl_name_id'], $tbl_name = $getInspection['tbl_name']);

			$data = array(
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
			);
			//XSS prevention
			$data = $this->security->xss_clean($data);
			$this->db->where('id', $getFormType['tbl_proprietor_id']);
			$result = $this->db->update('tbl_proprietor', $data);
			///////////////////////

			// upload proprietor shop images

			foreach ($shop_img as $key => $imageName) {
				$img = array(
					'tbl_proprietor_id' => $getFormType['tbl_proprietor_id'],
					'image_name' => $imageName,
				);
				$this->db->insert('tbl_proprietor_shop_images', $img);
			}
			// upload proprietor shop images

			if (($this->input->post('inspection_status') == '1')) {

				// hide the inspection button from inspector
				$data = array(
					'is_inspection' => '0',
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				$this->db->where('id', $this->input->post('id'));
				$result = $this->db->update('tbl_inspection', $data);

				// show the fees button to applicant
				$data = array(
					'is_fees' => '1',
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				$this->db->where('id', $getInspection['tbl_name_id']);
				$result = $this->db->update($getInspection['tbl_name'], $data);
			}

			if ($this->input->post('inspection_status') == '0') {
				$assign_to = '0';
				////////////email////////
				// $receiver = $result['email'];
				$getData = $this->common_model->getRecordById($getInspection['tbl_name_id'], $getInspection['tbl_name']);
				$getProprietor = $this->common_model->getRecordById($getData['tbl_proprietor_id'], 'tbl_proprietor');
				$getUserData = $this->common_model->getRecordById($getData['record_add_by'], 'tbl_user');

				$receiver = $getUserData['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ", Your license request has been rejected by inspector. Please check portal for details.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Applicant';
				// $redirection = 'view_form_8a';

				$this->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////
			} else if ($this->input->post('inspection_status') == '1') {
				$assign_to = '0';
				////////////email////////
				// $receiver = $result['email'];
				$getData = $this->common_model->getRecordById($getInspection['tbl_name_id'], $getInspection['tbl_name']);
				$getProprietor = $this->common_model->getRecordById($getData['tbl_proprietor_id'], 'tbl_proprietor');
				$getUserData = $this->common_model->getRecordById($getData['record_add_by'], 'tbl_user');

				$receiver = $getUserData['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ", Your license request has been Approved by inspector. and forwarded it for further proceedings. Please check portal for details and Pay the fees.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Applicant';
				// $redirection = 'view_form_8a';

				$this->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////
			} else if ($this->input->post('inspection_status') == '2') {
				$assign_to = '0';
				////////////email////////
				// $receiver = $result['email'];
				$getData = $this->common_model->getRecordById($getInspection['tbl_name_id'], $getInspection['tbl_name']);
				$getProprietor = $this->common_model->getRecordById($getData['tbl_proprietor_id'], 'tbl_proprietor');
				$getUserData = $this->common_model->getRecordById($getData['record_add_by'], 'tbl_user');

				$receiver = $getUserData['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ", Your license request status is in pending by inspector. Please check portal for details.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Applicant';
				// $redirection = 'view_form_8a';

				$this->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////
			}

			$data = array(
				'action_type' => 'update',
				'tbl_name' => $getInspection['tbl_name'],
				'tbl_name_id' => $getInspection['tbl_name_id'],
				'status' => $this->input->post('inspection_status'),
				'status_by' => $this->input->post('user_id'),
				// 'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td> Inspector Remarks: ' . $this->input->post('inspection_remarks') . '</tr></td>',
				'assign_to' => $assign_to,
				'assign_date' => date('Y-m-d'),
				// 'record_add_by' => $_SESSION['user_id'],
				'record_add_by' => $this->input->post('user_id'),
				'record_add_date' => date('Y-m-d'),
			);
			$data = $this->security->xss_clean($data);
			$this->db->insert('tbl_log', $data);

			return true;
		} else {
			return false;
		}
	}

	public function send_emails($receiver, $subject, $message, $notification_message) {

		$from = 'drugcontrolkp@gmail.com'; //sender's email
		//config email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		// $config['smtp_host'] = 'ssl://smtp.googlemail.com';

		$config['smtp_port'] = '465';
		$config['smtp_user'] = $from;
		$config['smtp_pass'] = 'awaiskhan@123'; //sender's password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = 'TRUE';
		$config['newline'] = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
		//send email
		$this->email->from($from, 'Drug Control & Pharmacy Services Health Department KP', 'no-reply');
		$this->email->to($receiver);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->reply_to('no-reply', 'no-reply');

		if ($this->email->send()) {
			//for testing
			$this->session->set_flashdata('custom', $notification_message);
			// redirect(base_url($redirection), 'refresh');
			return true;
		} else {
			$this->session->set_flashdata('error_custom', 'Email not sent');
			// show_error($this->email->print_debugger());
			return false;
		}
	}

}
