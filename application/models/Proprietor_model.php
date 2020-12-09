<?php
class Proprietor_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		//////// ajax and ssp////////
		// Set table name
		$this->table = 'tbl_proprietor';
		// Set orderable column fields
		$this->column_order = array(null, 'business_name', 'name', 'cnic_no', 'business_address');
		// Set searchable column fields
		$this->column_search = array('business_name', 'name', 'cnic_no', 'business_address');
		// Set default order
		$this->order = array('id' => 'desc');
		//////// ajax and ssp////////
	}

	public function getShowData($id) {
		$query = $this->db->query('SELECT * FROM tbl_proprietor
			LEFT JOIN tbl_more_proprietor ON tbl_proprietor.id = tbl_more_proprietor.tbl_proprietor_id where tbl_proprietor.id =' . $id . '');

		return $query->row();
	}
	public function add_proprietor() {
		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic_no' => $this->input->post('cnic_no'),
			'gender' => $this->input->post('gender'),
			'mobile_no' => $this->input->post('mobile_no'),
			'home_address' => $this->input->post('home_address'),
			'business_name' => ucwords($this->input->post('business_name')),
			'business_address' => $this->input->post('business_address'),
			'status' => '1',

			'tbl_user_id' => $_SESSION['user_id'],
			'record_add_by' => $_SESSION['user_id'],
			'record_add_date' => date('Y-m-d'),
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);

		//insertion in db
		$this->db->insert($this->table, $data);
		$last_insert_id = $this->db->insert_id();

		if ($this->db->affected_rows() > 0) {
			$count = count($this->input->post('proprietor_name'));
			// echo '<pre>';
			// var_dump($this->input->post('proprietor_name'));
			// exit;

			for ($x = 0; $x < $count; $x++) {
				$data = array(
					'proprietor_name' => ucwords($this->input->post('proprietor_name')[$x]),
					'proprietor_cnic_no' => $this->input->post('proprietor_cnic_no')[$x],
					'proprietor_mobile_no' => $this->input->post('proprietor_mobile_no')[$x],
					'tbl_proprietor_id' => $last_insert_id,
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);

				//insertion in db
				$this->db->insert('tbl_more_proprietor', $data);
			}
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

	public function update_proprietor() {

		$data = array(
			'name' => ucwords($this->input->post('name')),
			'father_name' => ucwords($this->input->post('father_name')),
			'cnic_no' => $this->input->post('cnic_no'),
			'gender' => $this->input->post('gender'),
			'mobile_no' => $this->input->post('mobile_no'),
			'home_address' => $this->input->post('home_address'),
			'business_name' => ucwords($this->input->post('business_name')),
			'business_address' => $this->input->post('business_address'),
		);
		//XSS prevention
		$data = $this->security->xss_clean($data);
		//updation in db
		$this->db->where('id', safe_decode($this->input->post('id')));
		$result = $this->db->update($this->table, $data);
		if ($result == true) {

			//first delete data from tbl_more_proprietor and then insert again
			$this->db->delete('tbl_more_proprietor', array('tbl_proprietor_id' => safe_decode($this->input->post('id'))));
			// then again insert it
			$count = count($this->input->post('proprietor_name'));
			for ($x = 0; $x < $count; $x++) {
				$data = array(
					'proprietor_name' => ucwords($this->input->post('proprietor_name')[$x]),
					'proprietor_cnic_no' => $this->input->post('proprietor_cnic_no')[$x],
					'proprietor_mobile_no' => $this->input->post('proprietor_mobile_no')[$x],
					'tbl_proprietor_id' => safe_decode($this->input->post('id')),
				);
				//XSS prevention
				$data = $this->security->xss_clean($data);

				//insertion in db
				$this->db->insert('tbl_more_proprietor', $data);
			}

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
		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	/*
		     * Count all records
	*/
	// public function countAll($id) {
	public function countAll() {
		$this->db->from($this->table);

		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}

		return $this->db->count_all_results();
	}

	/*
		     * Count records based on the filter params
		     * @param $_POST filter data based on the posted parameters
	*/
	// public function countFiltered($postData, $id) {
	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		if (!($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2')) {
			$this->db->where('record_add_by', $_SESSION['user_id']);
		}

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