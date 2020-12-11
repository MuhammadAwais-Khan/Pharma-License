<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Auth extends CI_Controller {
	function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();
		// $this->load->library('img_upload');
		$this->load->library('mathcaptcha');
		$config['operation'] = 'addition';
		$config['question_format'] = 'numeric';
		$config['answer_format'] = 'numeric';
		// $config['question_max_number_size'] = '10'; // maximum and default is 10
		$this->mathcaptcha->init($config);
	}
	public function index() {
		if ($this->session->has_userdata('is_user_login')) {
			redirect('dashboard');
		} else {
			redirect(base_url(), 'refresh');
		}
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

	public function user_registration() {

		$data['district'] = $this->common_model->fetchAllRecordsOrderByGroupBy('tbl_district', array('status' => '1'), $order = 'name asc', $group_by = null);
		if ($this->input->post('submit')) {
			//login info
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists|min_length[3]|max_length[20]|xss_clean|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[3]|max_length[20]|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'xss_clean|trim|matches[password]');

			$this->form_validation->set_rules('tbl_district_id', 'Selection', 'required|xss_clean|trim');
			//personal info
			$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'full name')), 'required|xss_clean|trim|min_length[3]|max_length[25]|alpha_numeric_spaces', array('alpha_numeric_spaces' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists|xss_clean|valid_email|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
			$this->form_validation->set_rules('captcha', 'Answer', 'required|callback__check_math_captcha');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['captcha_question'] = $this->mathcaptcha->get_question();
				$this->load->view('user/registration', $data);
			} else {

				$enc_pwd = safe_encode($this->input->post('password'));
				// $enc_pwd = $this->input->post('password');
				// to model
				$registration = $this->user_model->registration($enc_pwd);
				if ($registration == true) {
					$receiver = $this->input->post('email');

					$link = '<a href=' . base_url() . 'auth/confirmEmail/' . safe_encode($receiver) . '>Confirmation Link</a>';

					// $from = "awaisapex6@gmail.com"; //senders email address
					$subject = 'Confirm your Registration'; //email subject

					// $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
					//    <a href=\'http://mawaiskhan.com/email/Signup_Controller/confirmEmail/' . md5($receiver) . '\'>http://mawaiskhan.com/email/Signup_Controller/confirmEmail/' . md5($receiver) . '</a><br><br>Thanks';

					$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>
						Hi " . ucwords($this->input->post('name')) . "<br><br>
						You have received an email with a confirmation link . In order to complete the registration process, please click the confirmation link below.
						<br><br>
						" . $link . "<br><br>

						if you do not request for Registration, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

					$notification_message = '!Thanks for your registration, Please Check your inbox!. We just send you a request to confirm your registration';
					$redirection = 'login';

					$this->send_emails($receiver, $subject, $message, $redirection, $notification_message);

				}

				// set session message
				// $this->session->set_flashdata('custom', '!Thanks for your registration, Please Check your inbox!. We just send you a request to confirm your registration.');
				// redirect(base_url('login'));
			}
		} else {
			// $this->load->view('templates/header', $data);
			$data['captcha_question'] = $this->mathcaptcha->get_question();
			$this->load->view('user/registration', $data);
			// $this->load->view('templates/footer');
		}
	}

	function confirmEmail($hashcode) {
		// $result = $this->user_model->verifyEmail($hashcode);
		// var_dump($result);exit;

		if ($this->user_model->verifyEmail($hashcode)) {
			$this->session->set_flashdata('custom', 'Email address is confirmed. Please login to the system');
			redirect('login');
		} else {
			$this->session->set_flashdata('error_custom', 'Email address is not confirmed. Please try to re-register.');
			redirect('login');
		}
	}

	// user login
	public function user_login() {
		unset($this->session->userdata);

		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|trim|htmlspecialchars|min_length[5]|max_length[15]|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|htmlspecialchars|min_length[5]|max_length[15]|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			/////////// math captcha ///////

			$this->form_validation->set_rules('captcha', 'Answer', 'required|callback__check_math_captcha');
			/////////// math captcha ///////

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				unset($this->session->userdata);
				$data['captcha_question'] = $this->mathcaptcha->get_question();
				$this->load->view('login', $data);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
				);
				$result = $this->user_model->user_login($data);
				if ($result == TRUE) {
					$user_data = array(
						'user_id' => $result['id'],
						'username' => $result['username'],
						'name' => $result['name'],
						'tbl_role_id' => $result['tbl_role_id'],
						'is_user_login' => TRUE,
					);
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('custom', 'Welcome ' . $_SESSION['name']);
					redirect('dashboard', 'refresh');
				} else if ($result == FALSE) {
					$this->session->set_flashdata('error_msg', 'Invalid Username or Password!');
					redirect('login', 'refresh');
				}
			}
		} else {

			// $this->session->sess_destroy();
			unset($this->session->userdata);
			$data['captcha_question'] = $this->mathcaptcha->get_question();
			$this->load->view('login', $data);
			// $this->session->sess_destroy();
		}
	}

	function _check_math_captcha($str) {
		if ($this->mathcaptcha->check_answer($str)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_math_captcha', 'Your Answer is Wrong');
			return FALSE;
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	public function user_recover_password($email, $token) {
		$email = safe_decode($email);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[3]|max_length[20]|trim|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

			$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|xss_clean|trim|alpha_numeric|matches[password]');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$this->session->sess_destroy();

				$data['email'] = $this->input->post('email');
				$data['token'] = $this->input->post('token');

				$this->load->view('user/recover_password', $data);
			} else {
				$data = array(
					'password' => $this->input->post('password'),
					'email' => safe_decode($this->input->post('email')),
					'token' => $this->input->post('token'),
				);
				// update token varibale in DB
				$result = $this->user_model->user_change_password($data);
				if ($result == TRUE) {
					$this->session->set_flashdata('custom', 'Your Password has been changed successfully! Thank you');
					redirect(base_url('login'), 'refresh');

				} else if ($result == FALSE) {
					$this->session->set_flashdata('error_msg', 'Error! Invalid Email Address');
					redirect(base_url('login'), 'refresh');
				}
			}
		} else {
			if (empty($token)) {
				redirect(base_url('login'), 'refresh');
			}
			if (empty($email)) {
				redirect(base_url('login'), 'refresh');
			}

			$getUserDetail = $this->common_model->getRecordByArray('tbl_user', array('email' => $email, 'status' => '1', 'forgot_password_token' => $token));
			if (empty($getUserDetail)) {
				$this->session->set_flashdata('error_custom', 'Password Reset Link is Expired');
				redirect(base_url('login'));
				$this->session->sess_destroy();

			} else {
				$this->session->sess_destroy();
				$this->load->view('user/recover_password');
				$this->session->sess_destroy();
			}
		}
	}

	public function user_recover() {
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('email', 'Email Address', 'required|xss_clean|valid_email|trim');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$this->session->sess_destroy();
				$this->load->view('user/recover');
			} else {
				$data = array(
					'email' => $this->input->post('email'),
				);
				// update token varibale in DB
				$token = random_string('alnum', 16);
				$result = $this->user_model->user_recover($token, $data);
				if ($result == TRUE) {

					$receiver = $result['email'];

					$link = '<a href=' . base_url() . 'auth/user_recover_password/' . safe_encode($receiver) . '/' . $token . '>Reset / Change Password Link</a>';

					// $from = "awaisapex6@gmail.com"; //senders email address
					$subject = 'Drug Control & Pharmacy Services Health Department KP Changed / Reset Password Link'; //email subject
					// $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
					//    <a href=\'http://mawaiskhan.com/email/Signup_Controller/confirmEmail/' . md5($receiver) . '\'>http://mawaiskhan.com/email/Signup_Controller/confirmEmail/' . md5($receiver) . '</a><br><br>Thanks';

					$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>
						Hi " . $result['name'] . "<br><br>
						You have recently requested to Reset / Changed your password for Drug Control & Pharmacy Services Health Department KP Account. Click the link below <br><br>
						" . $link . "<br><br>
						if you do not request a password reset/change, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

					$notification_message = 'Password reset link has been sent to your email, Please login to your email for link.';
					$redirection = 'login';

					$this->send_emails($receiver, $subject, $message, $redirection, $notification_message);

				} else if ($result == FALSE) {
					$this->session->set_flashdata('error_msg', 'Invalid Email Address');
					redirect('login', 'refresh');
				}
			}
		} else {
			$this->session->sess_destroy();
			$this->load->view('user/recover');
			$this->session->sess_destroy();
			//die();
		}
	}

	public function send_emails($receiver, $subject, $message, $redirection, $notification_message) {

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
			redirect(base_url($redirection), 'refresh');
			return true;
		} else {
			$this->session->set_flashdata('error_custom', 'Email not sent');
			// show_error($this->email->print_debugger());
			return false;
		}
	}

	public function license_verification($tracking_code) {
		list($form) = explode('-', $tracking_code);

		$verify = $this->common_model->getRecordByArray('tbl_form_' . $form, array('tracking_code' => $tracking_code));
		if (!empty($verify)) {
			echo "Verified License";
		} else {
			echo "Not Verified License";
		}

	}

}
?>