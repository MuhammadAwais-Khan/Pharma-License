<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacist extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		if (!($_SESSION['tbl_role_id'] == '4')) {
			$this->session->sess_destroy();
			redirect('login', 'refresh');
		}
	}

	public function getData($id) {
		$data = $this->pharmacist_model->getRecordById($id);
		echo json_encode($data);
	}

	public function fetchData($id) {
		$data = $this->pharmacist_model->fetchData($id);
		echo json_encode($data);
	}

	public function add_pharmacist() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualified person name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('cnic', ucwords(str_replace('_', ' ', 'cnic')), 'xss_clean|trim|min_length[15]|max_length[15]');
		// $this->form_validation->set_rules('gender', 'Selection', 'required|xss_clean');

		// $this->form_validation->set_rules('dob', ucwords(str_replace('_', ' ', 'Date of birth')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));
		// $this->form_validation->set_rules('graduation_date', ucwords(str_replace('_', ' ', 'graduation_date')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));
		// $this->form_validation->set_rules('passing_year', ucwords(str_replace('_', ' ', 'passing_year')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));
		// $this->form_validation->set_rules('mobile_no', ucwords(str_replace('_', ' ', 'mobile_no')), 'required|xss_clean|trim|min_length[12]|max_length[12]');
		$this->form_validation->set_rules('pharmacy_reg_no', ucwords(str_replace('_', ' ', 'pharmacy_reg_no')), 'required|xss_clean|trim|min_length[3]|max_length[30]|is_unique[tbl_pharmacist.pharmacy_reg_no]');
		// $this->form_validation->set_rules('address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_pharmacist_category_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_institute_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_qualification_id', 'Selection', 'required|xss_clean');
		if (empty($_FILES['imageFile']['name'])) {
			$this->form_validation->set_rules('imageFile', 'Image', 'required|xss_clean');
		}

		// if (empty($_FILES['cnic_doc']['name'])) {
		// 	$this->form_validation->set_rules('cnic_doc', 'Document', 'required|xss_clean');
		// }

		// if (empty($_FILES['degree_doc']['name'])) {
		// 	$this->form_validation->set_rules('degree_doc', 'Document', 'required|xss_clean');
		// }

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'name' => form_error('name'),
				'father_name' => form_error('father_name'),
				'cnic' => form_error('cnic'),
				// 'gender' => form_error('gender'),
				// 'dob' => form_error('dob'),
				// 'mobile_no' => form_error('mobile_no'),
				// 'graduation_date' => form_error('graduation_date'),
				// 'passing_year' => form_error('passing_year'),
				'pharmacy_reg_no' => form_error('pharmacy_reg_no'),
				// 'address' => form_error('address'),
				'tbl_pharmacist_category_id' => form_error('tbl_pharmacist_category_id'),
				'tbl_qualification_id' => form_error('tbl_qualification_id'),
				'tbl_institute_id' => form_error('tbl_institute_id'),
				'imageFile' => form_error('imageFile'),
				// 'cnic_doc' => form_error('cnic_doc'),
				// 'degree_doc' => form_error('degree_doc'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			// $fileUpload->upload($_FILES["imageFile"]);
			$fileUpload = new \Verot\Upload\Upload($_FILES["imageFile"]);
			if ($fileUpload->uploaded == true) {
				$fileUpload->file_auto_rename = true;
				$fileUpload->mime_check = true;
				$fileUpload->file_max_size = '1000000'; // 1mb
				$fileUpload->allowed = array('image/*');
				$fileUpload->forbidden = array('application/*', 'text/*', 'video/*', 'audio/*');
				$fileUpload->no_script = false;
				$fileUpload->image_ratio = true;
				$fileUpload->image_ratio_crop = true;
				$fileUpload->image_ratio_fill = true;
				$fileUpload->image_resize = true;
				$fileUpload->image_x = 500;
				$fileUpload->image_ratio_y = true;
				//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
				$fileUpload->process('./assets/upload/images/pharmacist');
				if ($fileUpload->processed == true) {
					$pharmacist_img = $fileUpload->file_dst_name;
					$fileUpload->clean();

					// $result = $this->pharmacist_model->add_pharmacist($pharmacist_img);
					// $json = array(
					// 	'success' => false,
					// );
					// if ($result) {
					// 	$json = array(
					// 		'success' => true,
					// 	);
					// }

					// echo json_encode($json);
				} else {
					$json = array(
						'file' => $fileUpload->error,
					);
				}
			} else {

				$json = array(
					'file' => $fileUpload->error,
				);

			}
			/////cnic doc/////

			// $fileUpload->upload($_FILES["cnic_doc"]);
			// if ($fileUpload->uploaded == true) {
			// 	$fileUpload->file_auto_rename = true;
			// 	$fileUpload->mime_check = true;
			// 	$fileUpload->file_max_size = '1000000'; // 1mb
			// 	$fileUpload->allowed = array('image/*', 'application/pdf');
			// 	$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
			// 	$fileUpload->no_script = false;
			// 	$fileUpload->image_ratio = true;
			// 	$fileUpload->image_ratio_crop = true;
			// 	$fileUpload->image_ratio_fill = true;
			// 	$fileUpload->image_resize = true;
			// 	$fileUpload->image_x = 500;
			// 	$fileUpload->image_y = 500;
			// 	//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
			// 	$fileUpload->process('./assets/upload/images/cnic_doc');
			// 	if ($fileUpload->processed == true) {
			// 		$cnic_doc = $fileUpload->file_dst_name;
			// 		$fileUpload->clean();

			// 		// $result = $this->pharmacist_model->add_pharmacist($pharmacist_img);
			// 		// $json = array(
			// 		// 	'success' => false,
			// 		// );
			// 		// if ($result) {
			// 		// 	$json = array(
			// 		// 		'success' => true,
			// 		// 	);
			// 		// }

			// 		// echo json_encode($json);
			// 	} else {
			// 		$json = array(
			// 			'file' => $fileUpload->error,
			// 		);
			// 	}
			// } else {

			// 	$json = array(
			// 		'file' => $fileUpload->error,
			// 	);

			// }
			//////////

			// $fileUpload->upload($_FILES["degree_doc"]);
			// if ($fileUpload->uploaded == true) {
			// 	$fileUpload->file_auto_rename = true;
			// 	$fileUpload->mime_check = true;
			// 	$fileUpload->file_max_size = '1000000'; // 1mb
			// 	$fileUpload->allowed = array('image/*', 'application/pdf');
			// 	$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
			// 	$fileUpload->no_script = false;
			// 	$fileUpload->image_ratio = true;
			// 	$fileUpload->image_ratio_crop = true;
			// 	$fileUpload->image_ratio_fill = true;
			// 	$fileUpload->image_resize = true;
			// 	$fileUpload->image_x = 500;
			// 	$fileUpload->image_y = 500;
			// 	//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
			// 	$fileUpload->process('./assets/upload/images/degree_doc');
			// 	if ($fileUpload->processed == true) {
			// 		$degree_doc = $fileUpload->file_dst_name;
			// 		$fileUpload->clean();

			// 		// $result = $this->pharmacist_model->add_pharmacist($pharmacist_img);
			// 		// $json = array(
			// 		// 	'success' => false,
			// 		// );
			// 		// if ($result) {
			// 		// 	$json = array(
			// 		// 		'success' => true,
			// 		// 	);
			// 		// }

			// 		// echo json_encode($json);
			// 	} else {
			// 		$json = array(
			// 			'file' => $fileUpload->error,
			// 		);
			// 	}
			// } else {

			// 	$json = array(
			// 		'file' => $fileUpload->error,
			// 	);

			// }
			/////degree doc end/////

			// if (isset($degree_doc) && isset($cnic_doc) && isset($pharmacist_img)) {
			// 	$result = $this->pharmacist_model->add_pharmacist($pharmacist_img, $cnic_doc, $degree_doc);
			// 	$json = array(
			// 		'success' => false,
			// 	);
			// 	if ($result) {
			// 		$json = array(
			// 			'success' => true,
			// 		);
			// 	}

			// 	echo json_encode($json);
			// }

			if (isset($pharmacist_img)) {
				$result = $this->pharmacist_model->add_pharmacist($pharmacist_img);
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
		} // else end

	} // function end

	public function update_pharmacist() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualified person name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');

		$this->form_validation->set_rules('cnic', ucwords(str_replace('_', ' ', 'cnic')), 'xss_clean|trim|min_length[15]|max_length[15]');

		// $this->form_validation->set_rules('gender', 'Selection', 'required|xss_clean');

		// $this->form_validation->set_rules('dob', ucwords(str_replace('_', ' ', 'Date of birth')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));

		// $this->form_validation->set_rules('graduation_date', ucwords(str_replace('_', ' ', 'graduation_date')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));

		// $this->form_validation->set_rules('passing_year', ucwords(str_replace('_', ' ', 'passing_year')), 'required|xss_clean|trim|min_length[3]|max_length[12]|alpha_dash', array('alpha_dash' => 'The %s field may only contain Date characters.'));

		// $this->form_validation->set_rules('mobile_no', ucwords(str_replace('_', ' ', 'mobile_no')), 'required|xss_clean|trim|min_length[12]|max_length[12]');

		$this->form_validation->set_rules('pharmacy_reg_no', ucwords(str_replace('_', ' ', 'pharmacy_reg_no')), 'required|xss_clean|trim|min_length[3]|max_length[30]');
		// $this->form_validation->set_rules('address', ucwords(str_replace('_', ' ', 'address')), 'required|xss_clean|trim|min_length[3]');
		$this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_pharmacist_category_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_institute_id', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('tbl_qualification_id', 'Selection', 'required|xss_clean');
		// if (empty($_FILES['imageFile']['name'])) {
		// 	$this->form_validation->set_rules('imageFile', 'Image', 'required|xss_clean');
		// }
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'name' => form_error('name'),
				'father_name' => form_error('father_name'),
				'cnic' => form_error('cnic'),
				// 'gender' => form_error('gender'),
				// 'dob' => form_error('dob'),
				// 'mobile_no' => form_error('mobile_no'),
				// 'graduation_date' => form_error('graduation_date'),
				// 'passing_year' => form_error('passing_year'),
				'pharmacy_reg_no' => form_error('pharmacy_reg_no'),
				// 'address' => form_error('address'),
				'tbl_pharmacist_category_id' => form_error('tbl_pharmacist_category_id'),
				'tbl_qualification_id' => form_error('tbl_qualification_id'),
				'tbl_institute_id' => form_error('tbl_institute_id'),
				// 'imageFile' => form_error('imageFile'),
				'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {

			if (!empty($_FILES['imageFile']['name'])) {
				// $fileUpload->upload($_FILES["imageFile"]);
				$fileUpload = new \Verot\Upload\Upload($_FILES["imageFile"]);
				if ($fileUpload->uploaded == true) {
					$fileUpload->file_auto_rename = true;
					$fileUpload->mime_check = true;
					$fileUpload->file_max_size = '1000000'; // 1mb
					$fileUpload->allowed = array('image/*');
					$fileUpload->forbidden = array('application/*', 'text/*', 'video/*', 'audio/*');
					$fileUpload->no_script = false;
					$fileUpload->image_ratio = true;
					$fileUpload->image_ratio_crop = true;
					$fileUpload->image_ratio_fill = true;
					$fileUpload->image_resize = true;
					$fileUpload->image_x = 500;
					$fileUpload->image_ratio_y = true;
					//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
					$fileUpload->process('./assets/upload/images/pharmacist');

					if ($fileUpload->processed == true) {
						//del the previous/old image befor the update new one
						// get image name from directory against record id
						$imageName = $this->common_model->getImageNameById($this->input->post('id'), 'tbl_pharmacist');
						//del the image from folder
						$this->common_model->delImage($folderName = 'pharmacist', $imageName['image']);
						$pharmacist_img = $fileUpload->file_dst_name;
						$fileUpload->clean();

						// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
						// $json = array(
						// 	'success' => false,
						// );
						// if ($result) {
						// 	$json = array(
						// 		'success' => true,
						// 	);
						// }

						// echo json_encode($json);
					} else {
						$json = array(
							'file' => $fileUpload->error,
						);
					}
				} else {

					$json = array(
						'file' => $fileUpload->error,
					);
				}
			} else {
				$pharmacist_img = $this->input->post('hide_picture');
				// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
				// $json = array(
				// 	'success' => false,
				// );
				// if ($result) {
				// 	$json = array(
				// 		'success' => true,
				// 	);
				// }
				// echo json_encode($json);

			} // image upload end

			///////cnic doc /////

			// if (!empty($_FILES['cnic_doc']['name'])) {
			// 	$fileUpload->upload($_FILES["cnic_doc"]);
			// 	if ($fileUpload->uploaded == true) {
			// 		$fileUpload->file_auto_rename = true;
			// 		$fileUpload->mime_check = true;
			// 		$fileUpload->file_max_size = '1000000'; // 1mb
			// 		$fileUpload->allowed = array('image/*', 'application/pdf');
			// 		$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
			// 		$fileUpload->no_script = false;
			// 		$fileUpload->image_ratio = true;
			// 		$fileUpload->image_ratio_crop = true;
			// 		$fileUpload->image_ratio_fill = true;
			// 		$fileUpload->image_resize = true;
			// 		$fileUpload->image_x = 500;
			// 		$fileUpload->image_y = 500;
			// 		//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
			// 		$fileUpload->process('./assets/upload/images/cnic_doc');

			// 		if ($fileUpload->processed == true) {
			// 			//del the previous/old image befor the update new one
			// 			// get image name from directory against record id
			// 			$imageName = $this->common_model->getImageNameById($this->input->post('id'), 'tbl_pharmacist');
			// 			//del the image from folder
			// 			$this->common_model->delImage($folderName = 'cnic_doc', $imageName['cnic_doc']);
			// 			$cnic_doc = $fileUpload->file_dst_name;
			// 			$fileUpload->clean();

			// 			// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
			// 			// $json = array(
			// 			// 	'success' => false,
			// 			// );
			// 			// if ($result) {
			// 			// 	$json = array(
			// 			// 		'success' => true,
			// 			// 	);
			// 			// }

			// 			// echo json_encode($json);
			// 		} else {
			// 			$json = array(
			// 				'file' => $fileUpload->error,
			// 			);
			// 		}
			// 	} else {

			// 		$json = array(
			// 			'file' => $fileUpload->error,
			// 		);
			// 	}
			// } else {
			// 	$cnic_doc = $this->input->post('hide_cnic_doc');
			// 	// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
			// 	// $json = array(
			// 	// 	'success' => false,
			// 	// );
			// 	// if ($result) {
			// 	// 	$json = array(
			// 	// 		'success' => true,
			// 	// 	);
			// 	// }
			// 	// echo json_encode($json);
			// }

			///// degree doc///

			// if (!empty($_FILES['degree_doc']['name'])) {
			// 	$fileUpload->upload($_FILES["degree_doc"]);
			// 	if ($fileUpload->uploaded == true) {
			// 		$fileUpload->file_auto_rename = true;
			// 		$fileUpload->mime_check = true;
			// 		$fileUpload->file_max_size = '1000000'; // 1mb
			// 		$fileUpload->allowed = array('image/*', 'application/pdf');
			// 		$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
			// 		$fileUpload->no_script = false;
			// 		$fileUpload->image_ratio = true;
			// 		$fileUpload->image_ratio_crop = true;
			// 		$fileUpload->image_ratio_fill = true;
			// 		$fileUpload->image_resize = true;
			// 		$fileUpload->image_x = 500;
			// 		$fileUpload->image_y = 500;
			// 		//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
			// 		$fileUpload->process('./assets/upload/images/degree_doc');

			// 		if ($fileUpload->processed == true) {
			// 			//del the previous/old image befor the update new one
			// 			// get image name from directory against record id
			// 			$imageName = $this->common_model->getImageNameById($this->input->post('id'), 'tbl_pharmacist');
			// 			//del the image from folder
			// 			$this->common_model->delImage($folderName = 'degree_doc', $imageName['degree_doc']);
			// 			$degree_doc = $fileUpload->file_dst_name;
			// 			$fileUpload->clean();

			// 			// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
			// 			// $json = array(
			// 			// 	'success' => false,
			// 			// );
			// 			// if ($result) {
			// 			// 	$json = array(
			// 			// 		'success' => true,
			// 			// 	);
			// 			// }

			// 			// echo json_encode($json);
			// 		} else {
			// 			$json = array(
			// 				'file' => $fileUpload->error,
			// 			);
			// 		}
			// 	} else {

			// 		$json = array(
			// 			'file' => $fileUpload->error,
			// 		);
			// 	}
			// } else {
			// 	$degree_doc = $this->input->post('hide_degree_doc');
			// 	// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img);
			// 	// $json = array(
			// 	// 	'success' => false,
			// 	// );
			// 	// if ($result) {
			// 	// 	$json = array(
			// 	// 		'success' => true,
			// 	// 	);
			// 	// }
			// 	// echo json_encode($json);
			// } // degree doc end
			// if (isset($degree_doc) && isset($cnic_doc) && isset($pharmacist_img)) {
			if (isset($pharmacist_img)) {

				// $result = $this->pharmacist_model->update_pharmacist($pharmacist_img, $cnic_doc, $degree_doc);
				$result = $this->pharmacist_model->update_pharmacist($pharmacist_img);

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

		} // else end
		// echo json_encode($json);

	}

	public function view_pharmacist() {
		$data['form_type'] = $this->common_model->getAllRecordByArray('tbl_form_type', array('status' => '1'));

		$data['institute'] = $this->common_model->getAllRecordByArray('tbl_institute', array('status' => '1'));
		$data['pharmacist_category'] = $this->common_model->getAllRecordByArray('tbl_pharmacist_category', array('status' => '1'));
		$data['qualification'] = $this->common_model->getAllRecordByArray('tbl_qualification', array('status' => '1'));

		$data['page_title'] = 'View All qualified person';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('pharmacist/view_pharmacist', $data);
		$this->load->view('templates/footer');
	}

	public function get_pharmacist() {

		$data = $row = array();

		// Fetch pharmacist's records
		$pharmacistData = $this->pharmacist_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($pharmacistData as $pharmacistInfo) {
			$i++;
			$status = ($pharmacistInfo->status == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$getUser = $this->global->getRecordById($pharmacistInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $pharmacistInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$picture = '<div class="tz-gallery" style="text-align: center;">
                      <a class="lightbox" href="' . base_url() . IMG_UPLOAD_PATH . 'pharmacist/' . $pharmacistInfo->image . '">
                      <img class="img-thumbnail" height="80px" width="35%" src="' . base_url() . IMG_UPLOAD_PATH . 'pharmacist/' . $pharmacistInfo->image . '">
                      </a></div><script>baguetteBox.run(".tz-gallery")</script>';

			// $graduation_date = date('d-m-Y', strtotime($pharmacistInfo->graduation_date));

			$actionBtn = '
                <div class="btn-group btn-sm">
                  <!-- <button type="button" class="btn btn-default  btn-sm">Action</button> -->
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" onclick="getShowData(' . "'" . $pharmacistInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-success"><i class="fa fa-info-circle"></i> Detail</button>
                      </a></li>
                    <li><a href="javascript:void(0)" onclick="getData(' . "'" . $pharmacistInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</button>
                      </a></li>
                  </ul>
                </div>';
			$data[] = array($i, $pharmacistInfo->name, $pharmacistInfo->father_name, $pharmacistInfo->cnic, $pharmacistInfo->pharmacy_reg_no, $add_by_date, $status, $picture, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pharmacist_model->countAll(),
			"recordsFiltered" => $this->pharmacist_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
