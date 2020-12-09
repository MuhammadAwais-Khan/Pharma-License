<?php
class Other_pharmacist_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		//////// ajax and ssp////////
		// Set table name
		$this->table = 'tbl_pharmacist';
		// Set orderable column fields
		$this->column_order = array(null, 'name', 'father_name', 'cnic', 'pharmacy_reg_no');
		// Set searchable column fields
		$this->column_search = array('name', 'father_name', 'cnic', 'pharmacy_reg_no');
		// Set default order
		$this->order = array('id' => 'desc');
		//////// ajax and ssp////////
	}

	public function fetchData($id) {
		$query = $this->db->query('SELECT
			* from tbl_pharmacist
			where tbl_pharmacist.id =' . $id . '');

		return $query->row();
	}

	public function update_pharmacist_verification() {
		if ($this->input->post('is_verify') == 'yes') {
			$data = array(
				'is_verify' => $this->input->post('is_verify'),
				'engage' => 'yes',
				'verify_date' => date('Y-m-d'),
				'status' => '1',
			);

			//XSS prevention
			$data = $this->security->xss_clean($data);
			//updation in db
			$this->db->where('id', $this->input->post('other_pharmacist_id'));
			$result = $this->db->update('tbl_pharmacist', $data);
			if ($result == true) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}

	}

	// public function add_other_pharmacist($other_pharmacist_img, $cnic_doc, $degree_doc) {
	public function add_other_pharmacist($other_pharmacist_img) {
		// $dob = date('Y-m-d', strtotime($this->input->post('dob')));
		// $graduation_date = date('Y-m-d', strtotime($this->input->post('graduation_date')));
		// $passing_year = date('Y-m-d', strtotime($this->input->post('passing_year')));

		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic' => $this->input->post('cnic'),
			'pharmacy_reg_no' => $this->input->post('pharmacy_reg_no'),
			'category' => $this->input->post('category'),
			'institute' => $this->input->post('institute'),
			'qualification' => $this->input->post('qualification'),
			'image' => $other_pharmacist_img,
			'country' => $this->input->post('country'),
			'province' => $this->input->post('province'),
			'detail' => $this->input->post('detail'),
			'is_kp_province' => 'no',
			'is_verify' => 'no',
			'verify_date' => '',
			'status' => $this->input->post('status'),
			'record_add_by' => $_SESSION['user_id'],
			'record_add_date' => date('Y-m-d'),
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		//insertion in db
		$this->db->insert($this->table, $data);
		$last_insert_id = $this->db->insert_id();

		if ($this->db->affected_rows() > 0) {
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

	public function update_other_pharmacist($other_pharmacist_img) {

		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic' => $this->input->post('cnic'),
			'pharmacy_reg_no' => $this->input->post('pharmacy_reg_no'),
			'country' => ucwords($this->input->post('country')),
			'province' => ucwords($this->input->post('province')),
			'detail' => $this->input->post('detail'),
			'category' => ucwords($this->input->post('category')),
			'institute' => ucwords($this->input->post('institute')),
			'qualification' => ucwords($this->input->post('qualification')),
			'image' => $other_pharmacist_img,
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);
		//updation in db
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update($this->table, $data);
		if ($result == true) {
			return true;
		} else {
			return false;
		}
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
		$this->db->where('record_add_by', $_SESSION['user_id']);
		$query = $this->db->get();
		return $query->result();
	}

	/*
		     * Count all records
	*/
	public function countAll() {
		$this->db->from($this->table);
		$this->db->where('record_add_by', $_SESSION['user_id']);
		return $this->db->count_all_results();
	}

	/*
		     * Count records based on the filter params
		     * @param $_POST filter data based on the posted parameters
	*/
	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$this->db->where('record_add_by', $_SESSION['user_id']);

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