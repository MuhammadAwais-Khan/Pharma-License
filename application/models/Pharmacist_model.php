<?php
class Pharmacist_model extends CI_Model {
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
			tbl_pharmacist.name,`father_name`,`cnic`,
			`pharmacy_reg_no`,
			tbl_pharmacist.`status`,tbl_pharmacist_category.name as pharmacist_category,
			tbl_qualification.name as qualification, tbl_institute.name as institute,`image`
			FROM tbl_pharmacist
			LEFT JOIN tbl_institute ON tbl_pharmacist.tbl_institute_id = tbl_institute.id
			LEFT JOIN tbl_qualification ON tbl_pharmacist.tbl_qualification_id = tbl_qualification.id
			LEFT JOIN tbl_pharmacist_category ON tbl_pharmacist.tbl_pharmacist_category_id = tbl_pharmacist_category.id
			where tbl_pharmacist.id =' . $id . '');

		return $query->row();
	}

	// public function fetchData($id) {
	// 	$query = $this->db->query('SELECT
	// 		tbl_pharmacist.name,`father_name`,`cnic`,
	// 		-- `gender`,`dob`,`mobile_no`,	`graduation_date`,`passing_year`,
	// 		`pharmacy_reg_no`,
	// 		-- `address`,
	// 		tbl_pharmacist.`status`,tbl_pharmacist_category.name as pharmacist_category,
	// 		tbl_qualification.name as qualification, tbl_institute.name as institute,`image`,
	// 		-- cnic_doc,degree_doc
	// 		FROM tbl_pharmacist
	// 		LEFT JOIN tbl_institute ON tbl_pharmacist.tbl_institute_id = tbl_institute.id
	// 		LEFT JOIN tbl_qualification ON tbl_pharmacist.tbl_qualification_id = tbl_qualification.id
	// 		LEFT JOIN tbl_pharmacist_category ON tbl_pharmacist.tbl_pharmacist_category_id = tbl_pharmacist_category.id
	// 		where tbl_pharmacist.id =' . $id . '');

	// 	return $query->row();
	// }
	// public function add_pharmacist($pharmacist_img, $cnic_doc, $degree_doc) {
	public function add_pharmacist($pharmacist_img) {
		// $dob = date('Y-m-d', strtotime($this->input->post('dob')));
		// $graduation_date = date('Y-m-d', strtotime($this->input->post('graduation_date')));
		// $passing_year = date('Y-m-d', strtotime($this->input->post('passing_year')));

		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic' => $this->input->post('cnic'),
			// 'gender' => $this->input->post('gender'),
			// 'dob' => $dob,
			// 'mobile_no' => $this->input->post('mobile_no'),
			// 'graduation_date' => $graduation_date,
			// 'passing_year' => $passing_year,
			'pharmacy_reg_no' => $this->input->post('pharmacy_reg_no'),
			// 'address' => $this->input->post('address'),
			'tbl_pharmacist_category_id' => $this->input->post('tbl_pharmacist_category_id'),
			'tbl_institute_id' => $this->input->post('tbl_institute_id'),
			'tbl_qualification_id' => $this->input->post('tbl_qualification_id'),
			'image' => $pharmacist_img,
			// 'cnic_doc' => $cnic_doc,
			// 'degree_doc' => $degree_doc,
			'country' => 'Pakistan',
			'province' => 'KP',
			'detail' => '',
			'is_kp_province' => 'yes',
			'is_verify' => 'yes',
			'verify_date' => date('Y-m-d'),
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

	// public function update_pharmacist($pharmacist_img, $cnic_doc, $degree_doc) {
	public function update_pharmacist($pharmacist_img) {

		// $dob = date('Y-m-d', strtotime($this->input->post('dob')));
		// $graduation_date = date('Y-m-d', strtotime($this->input->post('graduation_date')));
		// $passing_year = date('Y-m-d', strtotime($this->input->post('passing_year')));

		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic' => $this->input->post('cnic'),
			// 'gender' => $this->input->post('gender'),
			// 'dob' => $dob,
			// 'mobile_no' => $this->input->post('mobile_no'),
			// 'graduation_date' => $graduation_date,
			// 'passing_year' => $passing_year,
			'pharmacy_reg_no' => $this->input->post('pharmacy_reg_no'),
			// 'address' => $this->input->post('address'),
			'tbl_pharmacist_category_id' => $this->input->post('tbl_pharmacist_category_id'),
			'tbl_institute_id' => $this->input->post('tbl_institute_id'),
			'tbl_qualification_id' => $this->input->post('tbl_qualification_id'),
			'image' => $pharmacist_img,
			// 'cnic_doc' => $cnic_doc,
			// 'degree_doc' => $degree_doc,
			'status' => $this->input->post('status'),
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