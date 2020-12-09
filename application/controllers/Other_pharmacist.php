<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Other_Pharmacist extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		// if ($_SESSION['tbl_other_pharmacist_id'] != '1') {
		// 	$this->session->sess_destroy();
		// 	redirect('admin', 'refresh');
		// }
	}

	public function verify_other_pharmacist() {

		$json = array();

		$this->form_validation->set_rules('is_verify', 'Selection', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'is_verify' => form_error('is_verify'),
			);
			echo json_encode($json);

		} else {
			$result = $this->other_pharmacist_model->update_pharmacist_verification();

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
		$data = $this->other_pharmacist_model->getRecordById($id);
		echo json_encode($data);
	}

	public function fetchData($id) {
		$data = $this->other_pharmacist_model->fetchData($id);
		echo json_encode($data);
	}

	public function add_other_pharmacist() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualified person name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('cnic', ucwords(str_replace('_', ' ', 'cnic')), 'xss_clean|trim|min_length[15]|max_length[15]');
		$this->form_validation->set_rules('pharmacy_reg_no', ucwords(str_replace('_', ' ', 'pharmacy_reg_no')), 'required|xss_clean|trim|min_length[3]|max_length[30]|is_unique[tbl_pharmacist.pharmacy_reg_no]');
		// $this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('category', ucwords(str_replace('_', ' ', ' category')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('qualification', ucwords(str_replace('_', ' ', ' qualification')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('institute', ucwords(str_replace('_', ' ', ' institute')), 'required|xss_clean|trim|min_length[1]|max_length[50]');

		$this->form_validation->set_rules('country', ucwords(str_replace('_', ' ', ' country')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('province', ucwords(str_replace('_', ' ', ' province')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('detail', ucwords(str_replace('_', ' ', ' detail')), 'required|xss_clean|trim|min_length[1]');

		if (empty($_FILES['imageFile']['name'])) {
			$this->form_validation->set_rules('imageFile', 'Image', 'required|xss_clean');
		}

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				// 'id' => form_error('id'),
				'name' => form_error('name'),
				'father_name' => form_error('father_name'),
				'cnic' => form_error('cnic'),
				'pharmacy_reg_no' => form_error('pharmacy_reg_no'),
				'country' => form_error('country'),
				'province' => form_error('province'),
				'detail' => form_error('detail'),

				'category' => form_error('category'),
				'qualification' => form_error('qualification'),
				'institute' => form_error('institute'),
				'imageFile' => form_error('imageFile'),
				// 'cnic_doc' => form_error('cnic_doc'),
				// 'degree_doc' => form_error('degree_doc'),
				// 'status' => form_error('status'),
			);
			echo json_encode($json);

		} else {
			$fileUpload = new \Verot\Upload\Upload($_FILES["imageFile"]);
			// $fileUpload->upload($_FILES["imageFile"]);
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
					$other_pharmacist_img = $fileUpload->file_dst_name;
					$fileUpload->clean();

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

			if (isset($other_pharmacist_img)) {
				$result = $this->other_pharmacist_model->add_other_pharmacist($other_pharmacist_img);
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

	public function update_other_pharmacist() {

		$json = array();

		$this->form_validation->set_rules('name', ucwords(str_replace('_', ' ', 'qualified person name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('father_name', ucwords(str_replace('_', ' ', ' father_name')), 'required|xss_clean|trim|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('cnic', ucwords(str_replace('_', ' ', 'cnic')), 'xss_clean|trim|min_length[15]|max_length[15]');
		$this->form_validation->set_rules('pharmacy_reg_no', ucwords(str_replace('_', ' ', 'pharmacy_reg_no')), 'required|xss_clean|trim|min_length[3]|max_length[30]');
		// $this->form_validation->set_rules('status', 'Selection', 'required|xss_clean');
		$this->form_validation->set_rules('category', ucwords(str_replace('_', ' ', ' category')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('qualification', ucwords(str_replace('_', ' ', ' qualification')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('institute', ucwords(str_replace('_', ' ', ' institute')), 'required|xss_clean|trim|min_length[1]|max_length[50]');

		$this->form_validation->set_rules('country', ucwords(str_replace('_', ' ', ' country')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('province', ucwords(str_replace('_', ' ', ' province')), 'required|xss_clean|trim|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('detail', ucwords(str_replace('_', ' ', ' detail')), 'required|xss_clean|trim|min_length[1]');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$json = array(
				'name' => form_error('name'),
				'father_name' => form_error('father_name'),
				'cnic' => form_error('cnic'),
				'pharmacy_reg_no' => form_error('pharmacy_reg_no'),
				'country' => form_error('country'),
				'province' => form_error('province'),
				'detail' => form_error('detail'),

				'category' => form_error('category'),
				'qualification' => form_error('qualification'),
				'institute' => form_error('institute'),
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
						$other_pharmacist_img = $fileUpload->file_dst_name;
						$fileUpload->clean();

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
				$other_pharmacist_img = $this->input->post('hide_picture');

			} // image upload end

			if (isset($other_pharmacist_img)) {

				$result = $this->other_pharmacist_model->update_other_pharmacist($other_pharmacist_img);

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

	public function view_other_pharmacist() {
		// $data['form_type'] = $this->common_model->getAllRecordByArray('tbl_form_type', array('status' => '1'));

		// $data['institute'] = $this->common_model->getAllRecordByArray('tbl_institute', array('status' => '1'));
		// $data['other_pharmacist_category'] = $this->common_model->getAllRecordByArray('tbl_other_pharmacist_category', array('status' => '1'));
		// $data['qualification'] = $this->common_model->getAllRecordByArray('tbl_qualification', array('status' => '1'));

		$data['page_title'] = 'View All non KP qualified person';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('other_pharmacist/view_other_pharmacist', $data);
		$this->load->view('templates/footer');
	}

	public function get_other_pharmacist() {

		$data = $row = array();

		// Fetch other_pharmacist's records
		$other_pharmacistData = $this->other_pharmacist_model->getRows($_POST);

		$i = $_POST['start'];
		foreach ($other_pharmacistData as $other_pharmacistInfo) {
			$i++;
			$status = ($other_pharmacistInfo->status == 1) ? '<span class="label label-success">Verified</span>' : '<span class="label label-danger">Not Verified</span>';

			$getUser = $this->global->getRecordById($other_pharmacistInfo->record_add_by, $tbl_name = 'tbl_user');
			$recordAddDate = $other_pharmacistInfo->record_add_date;
			$recordAddDate = date("d-M-Y", strtotime($recordAddDate));

			$add_by_date = 'Add by <i><strong>' . $getUser['name'] . '</strong> on <strong>' . $recordAddDate . '</strong></i>';

			$picture = '<div class="tz-gallery" style="text-align: center;">
                      <a class="lightbox" href="' . base_url() . IMG_UPLOAD_PATH . 'pharmacist/' . $other_pharmacistInfo->image . '">
                      <img class="img-thumbnail" height="80px" width="35%" src="' . base_url() . IMG_UPLOAD_PATH . 'pharmacist/' . $other_pharmacistInfo->image . '">
                      </a></div><script>baguetteBox.run(".tz-gallery")</script>';

			// $graduation_date = date('d-m-Y', strtotime($other_pharmacistInfo->graduation_date));

			$actionBtn = '
                <div class="btn-group btn-sm">
                  <!-- <button type="button" class="btn btn-default  btn-sm">Action</button> -->
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" onclick="getShowData(' . "'" . $other_pharmacistInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-success"><i class="fa fa-info-circle"></i> Detail</button>
                      </a></li>
                    <li><a href="javascript:void(0)" onclick="getData(' . "'" . $other_pharmacistInfo->id . "'" . ')">
                      <button type="button" id="item_edit" class="item_edit btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</button>
                      </a></li>
                  </ul>
                </div>';
			$data[] = array($i, $other_pharmacistInfo->name, $other_pharmacistInfo->father_name, $other_pharmacistInfo->cnic, $other_pharmacistInfo->pharmacy_reg_no, $other_pharmacistInfo->country . ' / ' . $other_pharmacistInfo->province, $add_by_date, $status, $picture, $actionBtn);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->other_pharmacist_model->countAll(),
			"recordsFiltered" => $this->other_pharmacist_model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
}
?>
