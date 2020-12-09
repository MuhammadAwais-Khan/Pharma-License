<?php
class MY_Controller extends CI_Controller {
	public $global = NULL;

	function __construct() {
		parent::__construct();
		$this->global = &get_instance();

		// if (!(($this->session->has_userdata('is_admin_login')) || ($this->session->has_userdata('is_user_login')))) {
		if (!(($this->session->has_userdata('is_user_login')))) {
			redirect(base_url('auth/logout'));
			// redirect('admin');
		}
	}

	public function count($tbl_name = null, $array = null) {
		$result = $this->common_model->count($tbl_name, $array);
		return $result;
	}
	public function fetchAllRecordsOrderByGroupBy($tbl_name = null, $array = null, $order_by = null, $group_by = null) {
		$result = $this->common_model->fetchAllRecordsOrderByGroupBy($tbl_name, $array, $order_by, $group_by);
		return $result;
	}

	public function getRecordById($id, $tbl_name) {
		$result = $this->common_model->getRecordById($id, $tbl_name);
		return $result;
	}

	public function getAllRecordByArray($tbl_name, $array) {
		$result = $this->common_model->getAllRecordByArray($tbl_name, $array);
		return $result;
	}

	public function getAllRecords($tbl_name) {
		$result = $this->common_model->getAllRecords($tbl_name);
		return $result;
	}
	public function getRecordByArray($tbl_name, $array) {
		$result = $this->common_model->getRecordByArray($tbl_name, $array);
		return $result;
	}

	public function getFormTypeDocForm8a($id) {
		$result = $this->form_8a_model->getFormTypeDocForm8a($id);
		return $result;
	}

	public function getFormTypeDocForm8b($id) {
		$result = $this->form_8b_model->getFormTypeDocForm8b($id);
		return $result;
	}

	public function getFormTypeDocForm8c($id) {
		$result = $this->form_8c_model->getFormTypeDocForm8c($id);
		return $result;
	}

	public function getFormTypeDocForm8d($id) {
		$result = $this->form_8d_model->getFormTypeDocForm8d($id);
		return $result;
	}

	// public function send_emails($receiver, $subject, $message, $redirection, $notification_message) {
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
?>
