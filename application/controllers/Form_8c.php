<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_8c extends MY_Controller {

	public function __construct() {
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		parent::__construct();

		// if ($_SESSION['tbl_admin_role_id'] != '1') {
		// 	$this->session->sess_destroy();
		// 	redirect('admin', 'refresh');
		// }
	}

	public function view_form_8c() {
		$data['district'] = $this->common_model->getAllRecordByArray('tbl_district', array('status' => '1'));

		$data['page_title'] = 'form 8C - Wholesale/Distribution applications';
		$data['description'] = '...';
		$this->load->view('templates/header', $data);
		$this->load->view('form_8c/view_form_8c', $data);
		$this->load->view('templates/footer');
	}

	public function add_form_8c() {

		$data['page_title'] = 'license form 8C - Wholesale/Distribution';
		$data['description'] = 'Apply license for Wholesale/Distribution ';
		$data['province'] = $this->common_model->getAllRecordByArray('tbl_province', array('status' => '1'));
		$data['proprietor'] = $this->common_model->getAllRecordByArray('tbl_proprietor', array('tbl_user_id' => $_SESSION['user_id'], 'status' => '1'));

		//form type ( form 8c Database ID is 1)
		$data['form_type_doc'] = $this->common_model->getAllRecordByArray('tbl_form_type_doc', array('status' => '1', 'tbl_form_type_id' => '3'));

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('tbl_form_type_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_proprietor_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_pharmacist_id', 'Registration No', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_district_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_tehsil_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('license_type', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('godaam_address', 'Godaam Address', 'required|xss_clean');

			$getDoc = $this->common_model->getAllRecordByArray('tbl_form_type_doc', array('tbl_form_type_id' => $this->input->post('tbl_form_type_id'), 'status' => '1'));
			foreach ($getDoc as $key => $getDocInfo) {

				if (empty($_FILES[$getDocInfo['tag_name']]['name'])) {
					$this->form_validation->set_rules($getDocInfo['tag_name'], $getDocInfo['name'], 'required|xss_clean');
				}
			}
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('form_8c/add_form_8c');
				$this->load->view('templates/footer');
			} else {

				foreach ($getDoc as $key => $getDocInfo) {
					$tbl_form_type_doc_id[] = $this->input->post('tbl_form_type_doc_id' . $getDocInfo['id']);
					$document_name[] = $this->input->post('document_name_' . $getDocInfo['tag_name']);

					// $fileUpload->upload($_FILES[$getDocInfo['tag_name']]);
					$fileUpload = new \Verot\Upload\Upload($_FILES[$getDocInfo['tag_name']]);

					if ($fileUpload->uploaded == true) {
						$fileUpload->file_auto_rename = true;
						$fileUpload->mime_check = true;
						$fileUpload->file_max_size = '1000000'; // 1mb
						$fileUpload->allowed = array('image/*', 'application/pdf');
						$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
						$fileUpload->no_script = false;
						//$fileUpload->image_min_width = 400;
						$fileUpload->image_ratio = true;
						$fileUpload->image_ratio_crop = true;
						$fileUpload->image_ratio_fill = true;
						$fileUpload->image_resize = true;
						$fileUpload->image_x = 500;
						$fileUpload->image_ratio_y = true;
						//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
						$fileUpload->process('./assets/upload/images/form_8c');
						if ($fileUpload->processed == true) {
							$form_type_docs[] = $fileUpload->file_dst_name;
							$fileUpload->clean();
						} else {
							$this->session->set_flashdata('img_upload_error', $fileUpload->error);
							redirect(base_url('add_form_8c'));
						}
					} else {
						$this->session->set_flashdata('img_upload_error', $fileUpload->error);
						redirect(base_url('add_form_8c'));
					}
				}
				// echo '<pre>';
				// var_dump($form_type_docs);
				// var_dump($this->input->post('document_name'));exit;
				// var_dump($document_name);
				// exit;

				// to model
				$this->form_8c_model->add_form_8c($form_type_docs, $document_name, $tbl_form_type_doc_id);
				// set session message
				$this->session->set_flashdata('add', '!');
				redirect(base_url('view_form_8c'));
			}

		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('form_8c/add_form_8c');
			$this->load->view('templates/footer');
		}
	}

	// public function getRecordById($id) {
	// 	$data = $this->form_8c_model->getRecordById($id);
	// 	echo json_encode($data);
	// }

	public function fetchDataFormTypeDoc($tbl_form_type_id) {
		$data = $this->apply_model->fetchDataFormTypeDoc($tbl_form_type_id);
		echo json_encode($data);
	}

	public function fetchDocFromApplicationDoc($tblFormTypeID, $tblFormApplyID) {
		$data = $this->apply_model->fetchDocFromApplicationDoc($tblFormTypeID, $tblFormApplyID);
		echo json_encode($data);
	}

	public function get_form_8c() {
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->form_8c_model->get_form_8c($postData);

		echo json_encode($data);

	}
	public function edit_dates($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('issue_date', ucwords(str_replace('_', ' ', 'issue_date')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('expiry_date', ucwords(str_replace('_', ' ', 'expiry_date')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['bank'] = $this->common_model->getAllRecordByArray('tbl_banks', array('status' => '1'));

				$data['all'] = $this->common_model->getRecordById(safe_decode($this->input->post('id')), 'tbl_application_renewel');

				$data['page_title'] = 'License Validity Dates';
				$data['description'] = '...';

				$this->load->view('templates/header', $data);
				$this->load->view('form_8c/edit_dates');
				$this->load->view('templates/footer');
			} else {

				$this->form_8c_model->edit_dates();
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_form_8c'));
			}
		} else {
			// $data['bank'] = $this->common_model->getAllRecordByArray('tbl_banks', array('status' => '1'));

			$data['all'] = $this->common_model->getRecordById($id, 'tbl_application_renewel');
			$data['page_title'] = 'License Validity Dates';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('form_8c/edit_dates');
			$this->load->view('templates/footer');
		}
	}

	public function edit_form_8c($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('tbl_form_type_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_proprietor_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_pharmacist_id', 'Registration No', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_province_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_district_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_tehsil_id', 'Selection', 'required|xss_clean');
			$this->form_validation->set_rules('godaam_address', 'Godaam Address', 'required|xss_clean');
			$this->form_validation->set_rules('license_type', 'Selection', 'required|xss_clean');

			$getDoc = $this->form_8c_model->getFormTypeDocForm8c($this->input->post('id'));
			foreach ($getDoc as $key => $getDocInfo) {
				// echo '<pre>';

				// var_dump($_FILES[$getDocInfo['tag_name']]['name']);

				// if ($_FILES[$getDocInfo['tag_name']]['name'] || $getDocInfo['document_tag_name']) {
				// 	echo "string";
				// }

				if (!($_FILES[$getDocInfo['tag_name']]['name'] || $getDocInfo['document_tag_name'])) {
					$this->form_validation->set_rules($getDocInfo['tag_name'], $getDocInfo['name'], 'required|xss_clean');
				}
			}
			// exit;

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {

				$data['all'] = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8c');

				$data['province'] = $this->common_model->getAllRecordByArray('tbl_province', array('status' => '1'));
				$data['proprietor'] = $this->common_model->getAllRecordByArray('tbl_proprietor', array('tbl_user_id' => $_SESSION['user_id'], 'status' => '1'));

				//form type ( form 8c Database ID is 1)
				$data['form_type_doc'] = $this->common_model->getAllRecordByArray('tbl_form_type_doc', array('status' => '1', 'tbl_form_type_id' => '3'));
				$data['page_title'] = 'Edit Apply for license info';
				$data['description'] = '...';

				$this->load->view('templates/header', $data);
				$this->load->view('form_8c/edit_form_8c');
				$this->load->view('templates/footer');
			} else {
				// get document and validate it
				// $getDoc = $this->common_model->getAllRecordByArray('tbl_form_type_doc', array('tbl_form_type_id' => $this->input->post('tbl_form_type_id'), 'status' => '1'));

				$getDoc = $this->form_8c_model->getFormTypeDocForm8c($this->input->post('id'));

				// echo "<pre>";
				// var_dump($getDoc);exit;

				foreach ($getDoc as $key => $getDocInfo) {
					//tbl_form_8c_apply_documents is the id of tbl_applicant_documents table

					// $tbl_form_type_doc_id[] = $this->input->post('tbl_form_type_doc_id' . $getDocInfo['id']);

					$tbl_form_type_doc_id[] = $this->input->post('tbl_form_type_doc_id' . $getDocInfo['tblFromTypeDocID']);

					$document_name[] = $this->input->post('document_name_' . $getDocInfo['tag_name']);

					if (!empty($_FILES[$getDocInfo['tag_name']]['name'])) {

						// if (!empty($_FILES[[$getDocInfo['tag_name']]['name'])) {
						// $fileUpload->upload($_FILES[$getDocInfo['tag_name']]);
						$fileUpload = new \Verot\Upload\Upload($_FILES[$getDocInfo['tag_name']]);
						if ($fileUpload->uploaded == true) {
							$fileUpload->file_auto_rename = true;
							$fileUpload->mime_check = true;
							$fileUpload->allowed = array('image/*', 'application/pdf');
							$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
							$fileUpload->no_script = false;
							//$fileUpload->image_min_width = 400;
							$fileUpload->file_max_size = '1000000'; // 1mb
							$fileUpload->image_ratio = true;
							$fileUpload->image_ratio_crop = true;
							$fileUpload->image_ratio_fill = true;
							$fileUpload->image_resize = true;
							$fileUpload->image_x = 500;
							$fileUpload->image_ratio_y = true;
							//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
							$fileUpload->process('./assets/upload/images/form_8c');
							if ($fileUpload->processed == true) {
								//del the previous/old image befor the update new one
								// get image name from directory against record id

								$imageName = $this->common_model->getImageNameById($this->input->post('tbl_form_8c_apply_documents' . $getDocInfo['tblForm8cApplyDocID']), 'tbl_form_8c_apply_documents');

								//del the image from folder

								$this->common_model->delImage($folderName = 'form_8c', $imageName['uploaded_document']);

								$form_type_docs[] = $fileUpload->file_dst_name;
								$fileUpload->clean();
							} else {
								$this->session->set_flashdata('img_upload_error', $fileUpload->error);
								redirect(base_url('view_form_8c'));
							}
						} else {
							$this->session->set_flashdata('img_upload_error', $fileUpload->error);
							redirect(base_url('view_form_8c'));
						}
					} else {
						$form_type_docs[] = $this->input->post('hide_document_' . $getDocInfo['tag_name']);
					}

				}

				// get the previous record for update pharmacist engage
				$getPreviousPharmacistID = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8c');
				// $getPharmacistData = $this->common_model->getRecordById($getPharmacistID['tbl_pharmacist_id'], 'tbl');

				$this->form_8c_model->update_form_8c($form_type_docs, $document_name, $tbl_form_type_doc_id, $getPreviousPharmacistID);
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_form_8c'));
			}
		} else {
			$data['all'] = $this->common_model->getRecordById($id, 'tbl_form_8c');

			$data['province'] = $this->common_model->getAllRecordByArray('tbl_province', array('status' => '1'));
			$data['proprietor'] = $this->common_model->getAllRecordByArray('tbl_proprietor', array('tbl_user_id' => $_SESSION['user_id'], 'status' => '1'));

			//form type ( form 8c Database ID is 1)
			$data['form_type_doc'] = $this->common_model->getAllRecordByArray('tbl_form_type_doc', array('status' => '1', 'tbl_form_type_id' => '3'));

			$data['page_title'] = 'license form 8C - Wholesale/Distribution';
			$data['description'] = 'Edit license for Wholesale/Distribution ';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('form_8c/edit_form_8c');
			$this->load->view('templates/footer');
		}
	}

	// add emp info

	public function fees_form_8c($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('tbl_bank', 'Selection', 'xss_clean');
			$this->form_validation->set_rules('tbl_bank_id', 'Selection', 'xss_clean');

			$this->form_validation->set_rules('challan_no', ucwords(str_replace('_', ' ', 'challan_no')), 'required|xss_clean|trim|min_length[3]');
			$this->form_validation->set_rules('amount', ucwords(str_replace('_', ' ', 'amount')), 'required|xss_clean|trim|min_length[3]');

			$this->form_validation->set_rules('challan_date', ucwords(str_replace('_', ' ', 'date')), 'required|xss_clean|trim|min_length[3]');

			if (empty($_FILES['fee_recipt']['name'] || $this->input->post('hide_fee_recipt'))) {
				$this->form_validation->set_rules('fee_recipt', 'Fee Recipt', 'required|xss_clean');
			}

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['bank'] = $this->common_model->getAllRecordByArray('tbl_banks', array('status' => '1'));

				$data['all'] = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8c');
				$data['page_title'] = 'Fee Detail';
				$data['description'] = '...';

				$this->load->view('templates/header', $data);
				$this->load->view('form_8c/fees_form_8c');
				$this->load->view('templates/footer');
			} else {

				if (!empty($_FILES['fee_recipt']['name'])) {
					// $fileUpload->upload($_FILES["fee_recipt"]);
					$fileUpload = new \Verot\Upload\Upload($_FILES["fee_recipt"]);

					if ($fileUpload->uploaded == true) {
						$fileUpload->file_auto_rename = true;
						$fileUpload->mime_check = true;
						$fileUpload->allowed = array('image/*', 'application/pdf');
						$fileUpload->forbidden = array('text/*', 'video/*', 'audio/*');
						$fileUpload->no_script = false;
						//$fileUpload->image_min_width = 400;
						$fileUpload->file_max_size = '1000000'; // 1mb
						$fileUpload->image_ratio = true;
						$fileUpload->image_ratio_crop = true;
						$fileUpload->image_ratio_fill = true;
						$fileUpload->image_resize = true;
						$fileUpload->image_x = 500;
						$fileUpload->image_ratio_y = true;
						//$imgUploadPath=base_url().IMG_UPLOAD_PATH.'user';
						$fileUpload->process('./assets/upload/images/fee_recipt');
						if ($fileUpload->processed == true) {
							//del the previous/old image befor the update new one
							// get image name from directory against record id
							$imageName = $this->common_model->getImageNameById($this->input->post('id'), 'tbl_form_8c');
							//del the image from folder
							$this->common_model->delImage($folderName = 'fee_recipt', $imageName['fee_recipt']);
							$fee_recipt = $fileUpload->file_dst_name;
							$fileUpload->clean();
						} else {
							$this->session->set_flashdata('img_upload_error', $fileUpload->error);
							redirect(base_url('fees_form_8c'));
						}
					} else {
						$this->session->set_flashdata('img_upload_error', $fileUpload->error);
						redirect(base_url('fees_form_8c'));
					}
				} else {
					$fee_recipt = $this->input->post('hide_fee_recipt');
				}

				$this->form_8c_model->fees_form_8c($fee_recipt);
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_form_8c'));
			}
		} else {
			$data['bank'] = $this->common_model->getAllRecordByArray('tbl_banks', array('status' => '1'));

			$data['all'] = $this->common_model->getRecordById($id, 'tbl_form_8c');
			$data['page_title'] = 'Fee Detail';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('form_8c/fees_form_8c');
			$this->load->view('templates/footer');
		}
	}

	public function edit_dg($id = null) {
		$id = safe_decode($id);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('remarks', ucwords(str_replace('_', ' ', 'dg remarks')), 'required|xss_clean|trim|min_length[3]');
			$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
			$this->form_validation->set_rules('tbl_inspector_id', 'Selection', 'xss_clean');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['inspector'] = $this->common_model->getAllRecordByArray('tbl_user', array('tbl_role_id' => '3', 'status' => '1'));
				$data['all'] = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8c');
				$data['page_title'] = 'DG Drug Section';
				$data['description'] = '...';

				$this->load->view('templates/header', $data);
				$this->load->view('form_8c/edit_dg');
				$this->load->view('templates/footer');
			} else {

				$this->form_8c_model->update_dg();
				$this->session->set_flashdata('updated', '!');
				redirect(base_url('view_form_8c'));
			}
		} else {
			$data['all'] = $this->common_model->getRecordById($id, 'tbl_form_8c');

			$data['inspector'] = $this->common_model->getAllRecordByArray('tbl_user', array('tbl_role_id' => '3', 'status' => '1', 'tbl_district_id' => $data['all']['tbl_district_id']));

			$data['page_title'] = 'DG Drug Section';
			$data['description'] = '...';
			if (empty($data['all'])) {
				show_404();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('form_8c/edit_dg');
			$this->load->view('templates/footer');
		}
	}

	public function getData($id) {
		$data = $this->apply_model->getRecordById($id);
		echo json_encode($data);
	}

	public function fetchBankBranchesByBankID($tbl_bank_id) {
		$data = $this->form_8c_model->fetchBankBranchesByBankID($tbl_bank_id);
		echo json_encode($data);
	}
}
?>
