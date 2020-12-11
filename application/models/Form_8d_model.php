<?php
class Form_8d_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('ciqrcode'); //qr code lib

		//////// ajax and ssp////////
		// Set table name
		$this->table = 'tbl_form_8d';
		// Set orderable column fields
		$this->column_order = array(null);
		// Set searchable column fields
		$this->column_search = array('tbl_proprietor_id');
		// Set default order
		$this->order = array('id' => 'desc');
		//////// ajax and ssp////////
	}

	public function edit_dates() {

		$issue_date = date('Y-m-d', strtotime($this->input->post('issue_date')));
		$expiry_date = date('Y-m-d', strtotime($this->input->post('expiry_date')));

		$data = array(
			'issue_date' => $issue_date,
			'expiry_date' => $expiry_date,
			'status' => '1',
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', safe_decode($this->input->post('id')));
		$result = $this->db->update('tbl_application_renewel', $data);

		if ($result == true) {
			// hide fees btn from applicant
			$getRecordByPostID = $this->common_model->getRecordById(safe_decode($this->input->post('id')), 'tbl_application_renewel');

			$getFormRecord = $this->common_model->getRecordById($getRecordByPostID['tbl_name_id'], $getRecordByPostID['tbl_name']);

			////////////////////qr code generation///////////
			$savename = safe_encode($getRecordByPostID['tbl_name_id'] . '_' . $getRecordByPostID['tbl_name']) . '.png';

			$link = site_url('lv/' . $getFormRecord['tracking_code']);

			$params['data'] = $link;
			$params['level'] = 'H';
			$params['size'] = 5;
			$params['savename'] = FCPATH . ('assets/upload/images/qr_codes/') . $savename;
			// $params['savename'] = site_url('assets/upload/images/qr_codes/') . $this->input->post('tbl_name_id') . '_' . $this->input->post('tbl_name') . '.png';
			$this->ciqrcode->generate($params);
			////////////////////qr code generation///////////

			$data = array(
				'is_fees' => '0',
				'is_dates' => '0',
				'is_print' => '1',
				'status' => '4',
				'qr_code' => $savename,
			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $getRecordByPostID['tbl_name_id']);
			$this->db->update($getRecordByPostID['tbl_name'], $data);

			// hide dates btn and show print btn to inspector

			$data = array(
				// 'is_dates' => '0',
				'is_print' => '1',
			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $this->input->post('tbl_inspection_id'));
			$this->db->update('tbl_inspection', $data);

			$data = array(
				'action_type' => 'update',
				'tbl_name' => $getRecordByPostID['tbl_name'],
				'tbl_name_id' => $getRecordByPostID['tbl_name_id'],
				// 'status' => $this->input->post('status'),
				'status' => '1',
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td> System Message: Issue date (' . $this->input->post('issue_date') . ') and Renewal date (' . $this->input->post('expiry_date') . ') are Set for License, Form is Ready to Print</tr></td>',
				// 'assign_to' => $this->input->post('assign_to'),
				'assign_to' => '0',
				'assign_date' => date('Y-m-d'),
				'record_add_by' => $_SESSION['user_id'],
				'record_add_date' => date('Y-m-d'),
			);
			$data = $this->security->xss_clean($data);
			$this->db->insert('tbl_log', $data);

			////////////email////////
			// $receiver = $result['email'];
			// $getData = $this->common_model->getRecordById($this->input->post('tbl_name_id'), $this->input->post('tbl_name'));
			$getProprietor = $this->common_model->getRecordById($getFormRecord['tbl_proprietor_id'], 'tbl_proprietor');

			$getUserData = $this->common_model->getRecordById($getFormRecord['record_add_by'], 'tbl_user');
			$receiver = $getUserData['email'];

			// $from = "awaisapex6@gmail.com"; //senders email address
			$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
			$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ". Your Form 8D certifictae has been approved and Ready to print. Please check details on portal.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

			$notification_message = 'Notification email sent to Applicant for Printing the License';
			$redirection = 'view_form_8d';

			$this->global->send_emails($receiver, $subject, $message, $notification_message);
			////////////email////////

			return true;
		} else {
			return false;
		}
	}

	public function getFormTypeDocForm8d($id) {
		$query = $this->db->query('SELECT
		   tbl_form_type_doc.id as tblFromTypeDocID,
		   tbl_form_type_doc.name as name,
		   tbl_form_type_doc.tag_name as tag_name,
		   tbl_form_type_doc.tbl_form_type_id as tbl_form_type_doc_fromTypeID,
		   tbl_form_8d_apply_documents.id as tblForm8dApplyDocID,
		   tbl_form_8d_apply_documents.uploaded_document as uploaded_document,
		   tbl_form_8d_apply_documents.document_name as document_name,
		   tbl_form_8d_apply_documents.document_tag_name as document_tag_name,
		   tbl_form_8d_apply_documents.tbl_form_8d_id as from8dID,
		   tbl_form_8d_apply_documents.tbl_form_type_id as tbl_form_8d_apply_documents_fromTypeID,
		   tbl_form_8d_apply_documents.tbl_form_type_doc_id as fromTypeDocID
		FROM
		   tbl_form_type_doc
		   left OUTER JOIN
		   tbl_form_8d_apply_documents  ON tbl_form_8d_apply_documents.tbl_form_8d_id= ' . $id . ' and tbl_form_type_doc.id=tbl_form_8d_apply_documents.tbl_form_type_doc_id and tbl_form_type_doc.tbl_form_type_id = 4 and tbl_form_8d_apply_documents.tbl_form_type_id = 4 where (tbl_form_type_doc.tbl_form_type_id = 4 and tbl_form_type_doc.status= 1 )');

		// return $query->row();
		return $query->result_array();

	}

	// public function update_form_8d($form_type_docs, $tbl_form_8d_apply_documents) {
	public function update_form_8d($form_type_docs, $document_name, $tbl_form_type_doc_id, $getPreviousPharmacistID) {

		// $bank_date = date('Y-m-d', strtotime($this->input->post('bank_date')));

		$data = array(
			'tbl_province_id' => $this->input->post('tbl_province_id'),
			'tbl_district_id' => $this->input->post('tbl_district_id'),
			'tbl_tehsil_id' => $this->input->post('tbl_tehsil_id'),
			'tbl_proprietor_id' => $this->input->post('tbl_proprietor_id'),
			'tbl_pharmacist_id' => $this->input->post('tbl_pharmacist_id'),
			'godaam_address' => $this->input->post('godaam_address'),
			'license_type' => $this->input->post('license_type'),

		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		if ($result == true) {

			// first update the previous pharmacist or qualified person engage coloumn
			$data = array(
				'engage' => 'no',

			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $getPreviousPharmacistID['tbl_pharmacist_id']);
			$this->db->update('tbl_pharmacist', $data);

			// first update the previous pharmacist or qualified person engage coloumn
			$data = array(
				'engage' => 'yes',

			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $this->input->post('tbl_pharmacist_id'));
			$this->db->update('tbl_pharmacist', $data);
			/////////////////////////////////////////////////////////////////////////////////

			//first delete data from table and then insert again with new values

			$this->db->delete('tbl_form_8d_apply_documents', array('tbl_form_8d_id' => $this->input->post('id')));

			$count = count($form_type_docs);

			for ($x = 0; $x < $count; $x++) {

				$data = array(
					'uploaded_document' => $form_type_docs[$x],
					'document_name' => str_replace('_', ' ', $document_name[$x]),
					'document_tag_name' => $document_name[$x],
					// 'tbl_form_8d_id' => $last_insert_id,
					'tbl_form_8d_id' => $this->input->post('id'),
					'tbl_form_type_id' => $this->input->post('tbl_form_type_id'),
					'tbl_form_type_doc_id' => $tbl_form_type_doc_id[$x],
					'record_add_by' => $_SESSION['user_id'],
					'record_add_date' => date('Y-m-d'),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);

				$this->db->insert('tbl_form_8d_apply_documents', $data);

			}

			$data = array(
				'action_type' => 'update',
				'license_type' => $this->input->post('license_type'),
				'tbl_name' => 'tbl_form_8d',
				'tbl_name_id' => $this->input->post('id'),
				'status' => '2',
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td>System Message: Record Update by Applicant</tr></td>',
				'assign_to' => '0',
				'assign_date' => date('Y-m-d'),
				'record_add_by' => $_SESSION['user_id'],
				'record_add_date' => date('Y-m-d'),
			);

			$data = $this->security->xss_clean($data);
			$this->db->insert('tbl_log', $data);

			return true;
		} else {
			return false;
		}
	}

	public function add_form_8d($form_type_docs, $document_name, $tbl_form_type_doc_id) {

		// $bank_date = date('Y-m-d', strtotime($this->input->post('bank_date')));

		$data = array(
			'tbl_form_type_id' => $this->input->post('tbl_form_type_id'),
			'tbl_province_id' => $this->input->post('tbl_province_id'),
			'tbl_district_id' => $this->input->post('tbl_district_id'),
			'tbl_tehsil_id' => $this->input->post('tbl_tehsil_id'),
			'tbl_proprietor_id' => $this->input->post('tbl_proprietor_id'),
			'tbl_pharmacist_id' => $this->input->post('tbl_pharmacist_id'),
			'godaam_address' => $this->input->post('godaam_address'),
			'license_type' => $this->input->post('license_type'),
			'status' => '2',
			'record_add_by' => $_SESSION['user_id'],
			'record_add_date' => date('Y-m-d'),

		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		//insertion in db
		$this->db->insert($this->table, $data);
		$last_insert_id = $this->db->insert_id();

		if ($this->db->affected_rows() > 0) {

			/////////update the tracking id for searching //////
			$code = str_shuffle($last_insert_id . random_string('alnum', 4));
			$tracking_code = '8d-' . $code;
			$data = array(
				'tracking_code' => $tracking_code,
			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $last_insert_id);
			$this->db->update($this->table, $data);
			/////////update the tracking id for searching //////
			// if ($this->input->post('qpp') == 'kp') {

			// update the pharmacist or qualified person engage coloumn
			$data = array(
				'engage' => 'yes',

			);
			//XSS prevention
			$data = $this->security->xss_clean($data);

			$this->db->where('id', $this->input->post('tbl_pharmacist_id'));
			$this->db->update('tbl_pharmacist', $data);
			// }

			//////////////////////////////////////////////////////////////////////////////

			$count = count($form_type_docs);

			for ($x = 0; $x < $count; $x++) {

				$data = array(
					'uploaded_document' => $form_type_docs[$x],
					'document_name' => str_replace('_', ' ', $document_name[$x]),
					'document_tag_name' => $document_name[$x],
					'tbl_form_8d_id' => $last_insert_id,
					'tbl_form_type_id' => $this->input->post('tbl_form_type_id'),
					'tbl_form_type_doc_id' => $tbl_form_type_doc_id[$x],
					'record_add_by' => $_SESSION['user_id'],
					'record_add_date' => date('Y-m-d'),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				//insertion in db
				$this->db->insert('tbl_form_8d_apply_documents', $data);
			}

			// for application log

			$data = array(
				'action_type' => 'add',
				'license_type' => $this->input->post('license_type'),
				'tbl_name' => 'tbl_form_8d',
				'tbl_name_id' => $last_insert_id,
				'status' => '2',
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td>System Message: Applicant Apply for Form 8d on ' . date('d-m-Y') . ', Upload the required documents</tr></td>',
				'assign_to' => '0',
				'assign_date' => date('Y-m-d'),
				'record_add_by' => $_SESSION['user_id'],
				'record_add_date' => date('Y-m-d'),
			);
			// XSS prevention
			$data = $this->security->xss_clean($data);
			// insertion in db
			$this->db->insert('tbl_log', $data);

			////////////email////////
			// $receiver = $result['email'];
			// $getData = $this->common_model->getRecordById($last_insert_id, 'tbl_form_8d');
			$getUserData = $this->common_model->getAllRecordByArray('tbl_user', array('tbl_role_id' => 2));
			foreach ($getUserData as $key => $getUserDataInfo) {

				$receiver = $getUserDataInfo['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>
				Dear DG Drug " . $getUserDataInfo['name'] . ", New Form 8D (Narcotics) application for License request has been received. Please check your dashboard.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Administration';
				// $redirection = 'view_form_8d';

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
			}
			////////////email////////
			return true;
		} else {
			return false;
		}
	}

	public function update_dg() {

		// $bank_date = date('Y-m-d', strtotime($this->input->post('bank_date')));

		$data = array(
			'status' => $this->input->post('status'),
			'remarks' => $this->input->post('remarks'),
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		if ($result == true) {

			$data = array(
				'action_type' => 'update',
				'tbl_name' => 'tbl_form_8d',
				'tbl_name_id' => $this->input->post('id'),
				'status' => $this->input->post('status'),
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td> DG Remarks: ' . $this->input->post('remarks') . '</tr></td>',
				'assign_to' => $this->input->post('assign_to'),
				'assign_date' => date('Y-m-d'),
				'record_add_by' => $_SESSION['user_id'],
				'record_add_date' => date('Y-m-d'),
			);
			$data = $this->security->xss_clean($data);
			$this->db->insert('tbl_log', $data);

			if (($this->input->post('status') == '1') && ($this->input->post('assign_to') > '0')) {

				// hide th edit button from applicant
				$data = array(
					'is_edit' => '0',
					'dg_approval_date' => date('Y-m-d'),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				$this->db->where('id', $this->input->post('id'));
				$result = $this->db->update('tbl_form_8d', $data);

				// assign to inspector
				$data = array(
					'tbl_name' => $this->input->post('tbl_name'),
					'tbl_name_id' => $this->input->post('id'),
					'tbl_form_type_id' => $this->input->post('tbl_form_type_id'),
					'inspector_id' => $this->input->post('assign_to'),
					'license_type' => $this->input->post('license_type'),
					'record_add_date' => date('Y-m-d'),
					// 'tbl_district_id' => $this->input->post('tbl_district_id'),
					// 'tbl_investor_id' => $this->input->post('tbl_investor_id'),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				$this->db->insert('tbl_inspection', $data);
				$last_inserted_inspection_id = $this->db->insert_id();

				// assign to inspector
				$data = array(
					'tbl_name' => $this->input->post('tbl_name'),
					'tbl_name_id' => $this->input->post('id'),
					'tbl_form_type_id' => $this->input->post('tbl_form_type_id'),
					'tbl_inspection_id' => $last_inserted_inspection_id,
					// 'issue_date' => $this->input->post('tbl_form_type_id'),
					// 'expiry_date' => $this->input->post('tbl_form_type_id'),
					// 'type' => $this->input->post('tbl_form_type_id'),
					'license_type' => $this->input->post('license_type'),
					'status' => '1',
					'record_add_by' => $_SESSION['user_id'],
					'record_add_date' => date('Y-m-d'),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);
				$this->db->insert('tbl_application_renewel', $data);

				////////////email////////
				// $receiver = $result['email'];
				$getData = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8d');
				$getProprietor = $this->common_model->getRecordById($getData['tbl_proprietor_id'], 'tbl_proprietor');
				$getUserData = $this->common_model->getRecordById($getData['record_add_by'], 'tbl_user');

				$receiver = $getUserData['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ", Your license request has been Approved for Inspection, and forwarded to Inspector for inspection.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Applicant';
				// $redirection = 'view_form_8d';

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////
			} else {
				// if rejected

				////////////email////////
				// $receiver = $result['email'];
				$getData = $this->common_model->getRecordById($this->input->post('id'), 'tbl_form_8d');
				$getProprietor = $this->common_model->getRecordById($getData['tbl_proprietor_id'], 'tbl_proprietor');
				$getUserData = $this->common_model->getRecordById($getData['record_add_by'], 'tbl_user');

				$receiver = $getUserData['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>

				Dear Proprieter " . $getProprietor['name'] . ", Your license request has been rejected. Please check portal for details.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Applicant';
				// $redirection = 'view_form_8d';

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////

			}

			return true;
		} else {
			return false;
		}
	}

	public function fees_form_8d($fee_recipt) {

		// $bank_date = date('Y-m-d', strtotime($this->input->post('bank_date')));

		$data = array(
			// 'status' => $this->input->post('status'),
			'status' => '1',
			'tbl_bank_id' => $this->input->post('tbl_bank_id'),
			'tbl_bank_branch_id' => $this->input->post('tbl_bank_branch_id'),
			'challan_no' => $this->input->post('challan_no'),
			'amount' => $this->input->post('amount'),
			'challan_date' => $this->input->post('challan_date'),
			'fee_recipt' => $fee_recipt,
			'is_dates' => '1',
			// 'is_fees' => '0',
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		if ($result == true) {

			// // show the dates btn to inspector
			// $data = array(
			// 	'is_dates' => '1',
			// );
			// //XSS prevention
			// $data = $this->security->xss_clean($data);

			// $this->db->where('tbl_name_id', $this->input->post('id'));
			// $this->db->where('tbl_name', 'tbl_form_8d');
			// $result = $this->db->update('tbl_inspection', $data);

			$data = array(
				'action_type' => 'update',
				'tbl_name' => 'tbl_form_8d',
				'tbl_name_id' => $this->input->post('id'),
				// 'status' => $this->input->post('status'),
				'status' => '1',
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td> System Message: Fees Payed By Applicant</tr></td>',
				// 'assign_to' => $this->input->post('assign_to'),
				'assign_to' => '0',
				'assign_date' => date('Y-m-d'),
				'record_add_by' => $_SESSION['user_id'],
				'record_add_date' => date('Y-m-d'),
			);
			$data = $this->security->xss_clean($data);
			$this->db->insert('tbl_log', $data);

			////////////email////////
			// $receiver = $result['email'];
			// $getData = $this->common_model->getRecordById($last_insert_id, 'tbl_form_8d');
			$getUserData = $this->common_model->getAllRecordByArray('tbl_user', array('tbl_role_id' => 2));
			foreach ($getUserData as $key => $getUserDataInfo) {

				$receiver = $getUserDataInfo['email'];

				// $from = "awaisapex6@gmail.com"; //senders email address
				$subject = 'Drug Control & Pharmacy Services Health Department KP'; //email subject
				$message = "This email is from Drug Control & Pharmacy Services Health Department KP.<br><br>
				Dear DG Drug " . $getUserDataInfo['name'] . ", Fees is Payed by Applicant for License request has been received. Please check your dashboard for further proceedings.

						<br>
						<br>

						if this email does not concern you, Please Ignore this email or delete this email<br><br>
						Thanks<br><br>
						Drug Control & Pharmacy Services Health Department KP Team";

				$notification_message = 'Notification email sent to Administration';
				// $redirection = 'view_form_8d';

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
			}
			////////////email////////

			return true;
		} else {
			return false;
		}
	}

	public function fetchBankBranchesByBankID($tbl_bank_id) {
		$this->db->select('*');
		$this->db->from('tbl_bank_branch');
		$this->db->where('tbl_banks_id', $tbl_bank_id);
		$this->db->where('status', '1');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Get DataTable data
	function get_form_8d($postData = null) {

		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		// Custom search filter
		$from_date = $postData['from_date'];
		$to_date = $postData['to_date'];
		// $from_dates = date('Y-m-d', strtotime($postData['from_date']));
		// $from_date = date('Y-m-d', strtotime($postData['from_date']));
		// echo $to_date = date('Y-m-d', strtotime($postData['to_date']));
		// $to_date = date('Y-m-d', strtotime($postData['to_date']));
		$tracking_code = $postData['tracking_code'];
		$tbl_district_id = $postData['tbl_district_id'];
		$status = $postData['status'];

		## Search
		$search_arr = array();
		$searchQuery = "";

		// if ($searchValue != '') {
		// $search_arr[] = " (godaam_address like '%" . $searchValue . "%') ";

		// $search_arr[] = " (tbl_district_id like '%" . $searchValue . "%' or
		// record_add_date BETWEEN '" . $searchValue . "' and '" . $searchValue . "'
		//  ) ";
		// }

		if ($from_date != '' && $to_date != '') {
			$from_date = date('Y-m-d', strtotime($postData['from_date']));
			$to_date = date('Y-m-d', strtotime($postData['to_date']));
			$search_arr[] = " record_add_date BETWEEN '" . $from_date . "' and '" . $to_date . "' ";

		}
		if ($tracking_code != '') {
			$search_arr[] = " tracking_code like '%" . $tracking_code . "%' ";
		}

		if ($status != '') {
			$search_arr[] = " status like '%" . $status . "%' ";
		}

		if ($tbl_district_id != '') {
			$search_arr[] = " tbl_district_id like '%" . $tbl_district_id . "%' ";
		}
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}
		$records = $this->db->get('tbl_form_8d')->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}

		$records = $this->db->get('tbl_form_8d')->result();
		$totalRecordwithFilter = $records[0]->allcount;
		## Fetch records
		$this->db->select('*');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}

		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$this->db->order_by('id', 'desc');
		$records = $this->db->get('tbl_form_8d')->result();

		$data = array();
		$i = 1;
		foreach ($records as $record) {

			if ($record->status == 2) {
				$status = '<span class="label label-primary">Pending/ Inprocess</span>';
			} else if ($record->status == 1) {
				$status = '<span class="label label-success">Approve for Inspection</span>';
			} else if ($record->status == 0) {
				$status = '<span class="label label-danger">Rejected / Not Approved</span>';
			} else if ($record->status == 4) {
				$status = '<span class="label label-success">Approved</span>';}
			$recordAddDate = date("d-M-Y", strtotime($record->record_add_date));

			$getProvince = $this->global->getRecordById($record->tbl_province_id, $tbl_name = 'tbl_province');
			$getDistrict = $this->global->getRecordById($record->tbl_district_id, $tbl_name = 'tbl_district');
			$getTehsil = $this->global->getRecordById($record->tbl_tehsil_id, $tbl_name = 'tbl_tehsil');
			$getProprietor = $this->global->getRecordById($record->tbl_proprietor_id, $tbl_name = 'tbl_proprietor');
			$getPharmacist = $this->global->getRecordById($record->tbl_pharmacist_id, $tbl_name = 'tbl_pharmacist');

			if ($_SESSION['tbl_role_id'] == '2') {
				$dgBtn = '<a href="' . site_url('form_8d/edit_dg/' . safe_encode($record->id)) . '">
                      <button type="button" class=" btn btn-sm btn-xs btn-info"><i class="fa fa-info-circle"></i> Detail</button>
                      </a>';
			} else {
				$dgBtn = "";
			}

			if ($record->id) {
				$logBtn = '<a href="' . site_url('common/logger/' . safe_encode($record->id) . '/tbl_form_8d') . '">
                      <button type="button" class="btn btn-sm btn-xs btn-primary"><i class="fa fa-history"></i> Activity </button>
                      </a>';
			} else {
				$logBtn = "";
			}

			if ($record->record_add_by == $_SESSION['user_id'] && $record->is_edit == '1') {
				$EditBtn = '<a href="' . site_url('form_8d/edit_form_8d/' . safe_encode($record->id)) . '">
                      <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</button>
                      </a>';
			} else {
				$EditBtn = "";
			}

			if ($record->record_add_by == $_SESSION['user_id'] && $record->is_fees == '1') {
				$FeesBtn = '<a href="' . site_url('form_8d/fees_form_8d/' . safe_encode($record->id)) . '">
                      <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> Fees</button>
                      </a>';
			} else {
				$FeesBtn = "";
			}

			$getDates = $this->global->getRecordByArray($tbl_name = 'tbl_application_renewel', array('tbl_name' => 'tbl_form_8d', 'tbl_name_id' => $record->id));

			if ($record->is_dates == '1' && $_SESSION['tbl_role_id'] == '2') {

				$datesBtn = '<a href="' . site_url('form_8d/edit_dates/' . safe_encode($getDates['id'])) . '">
			                   <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i> License Validity Dates</button>
			                   </a>';
			} else { $datesBtn = "";}

			// $getInspection = $this->global->getRecordByArray('tbl_inspection', array('tbl_name' => 'tbl_form_8d', 'tbl_name_id' => $record->id));

			if ($record->is_print == '1') {
				$printBtn = '<a href="' . site_url('common/print_license/' . safe_encode('tbl_form_8d') . '/' . safe_encode($record->id) . '') . '">
                      <button type="button" onclick="overlay()" class="btn btn-sm btn-xs btn-success"><i class="fa fa-print"></i> Print License</button>
                      </a>';
			} else { $printBtn = "";}

			// if ($record->is_print == '1') {
			$printPDFBtn = '<a href="' . site_url('common/pdf/' . safe_encode('tbl_form_8d') . '/' . safe_encode($record->id) . '') . '">
                      <button type="button" onclick="overlay()" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-file-pdf-o"></i> Print Detail</button>
                      </a>';
			// } else { $printBtn = "";}

			if ($getPharmacist['is_verify'] == 'no') {
				$is_verify = '<span class="label label-danger">No</span>';
			} else if ($getPharmacist['is_verify'] == 'yes') {
				$is_verify = '<span class="label label-success">Yes</span>';
			}

			$actionBtn =
				'<div class="btn-group">
                  <!-- <button type="button" class="btn btn-default  btn-sm">Action</button> -->
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>' . $dgBtn . '</li>
                    <li>' . $EditBtn . '</li>
                    <li>' . $FeesBtn . '</li>
                    <li>' . $datesBtn . '</li>
                    <li>' . $logBtn . '</li>
                    <li>' . $printPDFBtn . '</li>
                    <li>' . $printBtn . '</li>

                  </ul>
                </div>
                ';

			$data[] = array(
				"no" => $i,
				"proprietor" => $getProprietor['name'],
				"qualifiedPerson" => $getPharmacist['name'],
				"qualifiedPersonCountry" => $getPharmacist['country'] . ' / ' . $getPharmacist['province'],
				"proprietorProvince" => $getProvince['name'] . ' / ' . $getDistrict['name'] . ' / ' . $getTehsil['name'],
				"receivedDate" => $recordAddDate,
				"verified" => $is_verify,
				"status" => $status,
				"trackingCode" => $record->tracking_code,
				"action" => $actionBtn,
			);
			$i++;
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
		);

		return $response;
	}
}
?>