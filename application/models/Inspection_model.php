<?php
class Inspection_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		//////// ajax and ssp////////
		// Set table name
		$this->table = 'tbl_inspection';
		// Set orderable column fields
		$this->column_order = array(null, 'tbl_form_type_id');
		// Set searchable column fields
		$this->column_search = array('tbl_form_type_id');
		// Set default order
		$this->order = array('id' => 'desc');
		//////// ajax and ssp////////
	}

	public function fetchDataFormTypeDoc($tbl_form_type_id) {
		$query = $this->db->query('SELECT * from tbl_form_type_doc where tbl_form_type_id =' . $tbl_form_type_id . ' and status = 1');

		return $query->result();
	}

	public function fetchDocFromApplicationDoc($tblFormTypeID, $tblFormApplyID) {
		$query = $this->db->query('SELECT * from tbl_applicant_documents where tbl_form_type_id =' . $tblFormTypeID . ' and tbl_application_id = ' . $tblFormApplyID . '');

		return $query->result();
	}

	public function update_inspection() {
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
			'inspection_status' => $this->input->post('inspection_status'),
			'inspect_by' => $_SESSION['user_id'],

		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);

		if ($result == true) {

			$getInspection = $this->global->getRecordById($this->input->post('id'), $tbl_name = 'tbl_inspection');

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

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
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

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
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

				$this->global->send_emails($receiver, $subject, $message, $notification_message);
				////////////email////////
			}

			$data = array(
				'action_type' => 'update',
				'tbl_name' => $getInspection['tbl_name'],
				'tbl_name_id' => $getInspection['tbl_name_id'],
				'status' => $this->input->post('inspection_status'),
				'status_by' => $_SESSION['user_id'],
				'status_date' => date('Y-m-d'),
				'remarks' => '<tr><td> Inspector Remarks: ' . $this->input->post('inspection_remarks') . '</tr></td>',
				'assign_to' => $assign_to,
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

	public function getRecordById($id) {
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	//////////////// below ajax and server side processing datatable ///////////

	/*
		     * Fetch members data from the database
		     * @param $_POST filter data based on the posted parameters
	*/
	public function getRows($postData) {
		$this->_get_datatables_query($postData);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$this->db->where('inspector_id', $_SESSION['user_id']);

		$query = $this->db->get();
		return $query->result();
	}

	/*
		     * Count all records
	*/
	public function countAll() {
		$this->db->from($this->table);
		$this->db->where('inspector_id', $_SESSION['user_id']);
		return $this->db->count_all_results();
	}

	/*
		     * Count records based on the filter params
		     * @param $_POST filter data based on the posted parameters
	*/
	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$this->db->where('inspector_id', $_SESSION['user_id']);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/*
		     * Perform the SQL queries needed for an server-side processing requested
		     * @param $_POST filter data based on the posted parameters
	*/
	private function _get_datatables_query($postData) {

		$this->db->from($this->table);

		$i = 0;
		// loop searchable columns
		foreach ($this->column_search as $item) {
			// if datatable send POST for search
			if ($postData['search']['value']) {
				// first loop
				if ($i === 0) {
					// open bracket
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}

				// last loop
				if (count($this->column_search) - 1 == $i) {
					// close bracket
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	//////////////// above ajax and server side processing datatable ///////////

}
?>