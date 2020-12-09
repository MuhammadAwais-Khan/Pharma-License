<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
use \Firebase\JWT\JWT;

class Api extends \Restserver\Libraries\REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
	}
	/**
	 * User Login API
	 * --------------------
	 * @link: user/login
	 */
	public function login_post() {
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|trim|htmlspecialchars|min_length[5]|max_length[15]|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|htmlspecialchars|min_length[5]|max_length[15]|alpha_numeric', array('alpha_numeric' => 'The %s field may only contain A-Z, a-z and 0-9 characters.'));

		if ($this->form_validation->run() == FALSE) {
			$message = array(
				'status' => false,
				'error' => $this->form_validation->error_array(),
				'message' => "Please Fill all fields",
			);
			$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
			);
			$output = $this->api_model->user_login($data);
			if ($output) {
				$date = new DateTime();
				$token['id'] = $output->id;
				$token['username'] = $output->username;
				// $token['password'] = $output->password;
				$token['name'] = $output->name;
				$token['email'] = $output->email;
				$token['iat'] = $date->getTimestamp();
				$token['exp'] = $date->getTimestamp() + 60 * 60 * 24;
				$res = JWT::encode($token, 'JWT_KEY');

				$return_data = [
					'id' => $output->id,
					'name' => $output->name,
					'username' => $output->username,
					'email' => $output->email,
					'token' => $res,
				];

				$message = [
					'status' => true,
					'data' => $return_data,
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				$message = [
					'status' => FALSE,
					'message' => "Invalid Username or Password",
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}

	//  get all inspections
	public function all_inspection_get($id = 0) {
		// $inspector_id = '';
		// if (@$_GET['inspector_id']) {
		// 	$inspector_id = $_GET['inspector_id'];
		// }
		$inspector_id = $id;

		$response["data"] = array();
		// $sources = $this->api_model->fetch_all('tbl_inspection');
		$sources = $this->api_model->read_conditionally('tbl_inspection', $inspector_id, 'inspector_id');
		if (!empty($sources)) {
			foreach ($sources as $row) {
				$data['id'] = $row['id'];

				$getApplication = $this->api_model->getRecordById($row['tbl_name_id'], $tbl_name = $row['tbl_name']);

				$getFormType = $this->api_model->getRecordById($getApplication['tbl_form_type_id'], $tbl_name = 'tbl_form_type');
				$data['application_type'] = $getFormType['name']; // tbl_form_type_id

				$getProprietor = $this->api_model->getRecordById($getApplication['tbl_proprietor_id'], $tbl_name = 'tbl_proprietor');
				$data['proprietor_name'] = $getProprietor['name'];

				$data['application_date'] = $getApplication['record_add_date'];

				$getPharmacist = $this->api_model->getRecordById($getApplication['tbl_pharmacist_id'], $tbl_name = 'tbl_pharmacist');
				$data['qualified_person'] = $getPharmacist['name'];
				$data['proprietor_no'] = $getProprietor['mobile_no'];

				$data['dg_assign_date'] = $row['record_add_date'];

				$data['is_inspection'] = $row['is_inspection'];

				// $data['status'] = $row['status'];
				array_push($response["data"], $data);
				$response['success'] = 200;
			}
		} else {
			$response['message'] = 'No data found';
			$response['success'] = 0;
		}
		$this->response($response);
	}

	//  inspection by id
	public function inspection_get($id = 0) {
		// $inspector_id = '';
		// if (@$_GET['inspector_id']) {
		// 	$inspector_id = $_GET['inspector_id'];
		// }
		// $inspector_id = $id;

		$response["data"] = array();
		// $sources = $this->api_model->fetch_all('tbl_inspection');
		$sources = $this->api_model->read_conditionally('tbl_inspection', $id, 'id');
		if (!empty($sources)) {
			foreach ($sources as $row) {
				$data['id'] = $row['id'];

				$getApplication = $this->api_model->getRecordById($row['tbl_name_id'], $tbl_name = $row['tbl_name']);

				$getProprietor = $this->api_model->getRecordById($getApplication['tbl_proprietor_id'], $tbl_name = 'tbl_proprietor');
				$data['name_of_the_premises'] = $getProprietor['business_name'];
				$data['business_address'] = $getProprietor['business_address'];
				$data['inspection_date'] = $row['inspection_date'];
				$data['inspection_reason'] = $row['inspection_reason'];

				$getFormType = $this->api_model->getRecordById($getApplication['tbl_form_type_id'], $tbl_name = 'tbl_form_type');
				$data['type_of_license'] = $getFormType['name']; // tbl_form_type_id

				$data['license_validity'] = $row['license_validity'];

				$data['name_of_proprietor'] = $getProprietor['name'];

				$getPharmacist = $this->api_model->getRecordById($getApplication['tbl_pharmacist_id'], $tbl_name = 'tbl_pharmacist');
				$data['name_of_qualified_person'] = $getPharmacist['name'];

				$data['proprieter_qualified_present'] = $row['proprieter_qualified_present'];
				$data['sign_board'] = $row['sign_board'];
				$data['area'] = $row['area'];
				$data['front_area'] = $row['front_area'];
				$data['protected'] = $row['protected'];
				$data['thermometer'] = $row['thermometer'];
				$data['cold_chain'] = $row['cool_chin'];
				$data['adequate_light'] = $row['adequate_light'];
				$data['painted'] = $row['painted'];
				$data['almiras_wooden'] = $row['almiras_wooden'];
				$data['almiras_glass'] = $row['almiras_glass'];
				$data['almiras_metal'] = $row['almiras_metal'];
				$data['inspection_remarks'] = $row['inspection_remarks'];
				$data['inspection_status'] = $row['inspection_status'];

				array_push($response["data"], $data);
				$response['success'] = 200;
			}
		} else {
			$response['message'] = 'No data found';
			$response['success'] = 0;
		}
		$this->response($response);
	}

	public function edit_inspection_post() {

		$this->form_validation->set_rules('id', ucwords(str_replace('_', ' ', 'id')), 'required|xss_clean|trim|min_length[1]');
		$this->form_validation->set_rules('user_id', ucwords(str_replace('_', ' ', 'user_id')), 'required|xss_clean|trim|min_length[1]');
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
		$this->form_validation->set_rules('latitude', ucwords(str_replace('_', ' ', 'latitude')), 'required|xss_clean|min_length[3]');
		$this->form_validation->set_rules('longitude', ucwords(str_replace('_', ' ', 'longitude')), 'required|xss_clean|min_length[3]');

		if ($this->form_validation->run() == FALSE) {
			$message = array(
				'status' => false,
				'error' => $this->form_validation->error_array(),
				'message' => "Please Fill all fields",
			);
			$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		} else {

			$files = array();
			foreach ($_FILES['image_name'] as $k => $l) {
				foreach ($l as $i => $v) {
					if (!array_key_exists($i, $files)) {
						$files[$i] = array();
					}

					$files[$i][$k] = $v;
				}
			}

			foreach ($files as $file) {
				$img_upload = new \Verot\Upload\Upload($file);

				// $img_upload = new Img_upload($file);
				if ($img_upload->uploaded == true) {

					$img_upload->file_auto_rename = true;
					$img_upload->mime_check = true;
					$img_upload->file_max_size = '1000000'; // 1mb
					$img_upload->allowed = array('image/*');
					$img_upload->forbidden = array('application/*', 'text/*', 'video/*', 'audio/*');
					$img_upload->no_script = false;
					//$img_upload->image_min_width = 400;
					$img_upload->image_ratio = true;
					$img_upload->image_ratio_crop = true;
					$img_upload->image_ratio_fill = true;
					$img_upload->image_resize = true;
					$img_upload->image_x = 500;
					// $img_upload->image_y = 500;
					$img_upload->image_ratio_y = true;
					$img_upload->process('./assets/upload/images/shop_images');

					if ($img_upload->processed == true) {
						$shop_img[] = $img_upload->file_dst_name;
						$img_upload->clean();
					} else {
						$this->session->set_flashdata('img_upload_error', $img_upload->error);
						// redirect(base_url('product/add_product'));
					}
				} else {
					$this->session->set_flashdata('img_upload_error', $img_upload->error);
					// redirect(base_url('product/add_product'));
				}
				unset($img_upload);
			} // end foreach

			if ($res = $this->api_model->update_inspections($shop_img)) {
				$response['message'] = 'key update  successfuly';
				$response['success'] = 200;
				echo json_encode($response);
			}
		}
	}

	public function getRecordById($id, $tbl_name) {
		$result = $this->common_model->getRecordById($id, $tbl_name);
		return $result;
	}

}