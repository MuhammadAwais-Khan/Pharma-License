<?php
class Common_model extends CI_Model {
	public function __construct() {
		$this->load->database();

	}

	public function count($tbl_name, $array = null) {

		$this->db->select('count(*)');
		$this->db->from($tbl_name);
		if ($array) {
			$this->db->where($array);
		}
		$query = $this->db->get();
		$count = $query->row_array();
		return $count['count(*)'];
	}

	public function fetchAllRecordsOrderByGroupBy($tbl_name, $array = null, $order_by = null, $group_by = null) {
		$this->db->select('*');
		$this->db->from($tbl_name);
		if ($array) {
			$this->db->where($array);
		}
		if ($order_by) {
			$this->db->order_by($order_by);
		}

		if ($group_by) {
			$this->db->group_by($group_by);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAllRecordByArray($tbl_name, $array) {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get_where($tbl_name, $array);
		return $query->result_array();
	}

	public function getRecordByArray($tbl_name, $array) {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get_where($tbl_name, $array);
		return $query->row_array();
	}
	public function deleteRecordByID($del_id, $tbl_name) {
		// $this->db->delete($tbl_name, array('id' => $del_id));
		// return true;
		// return $this->db->error();
		if (!$this->db->delete($tbl_name, array('id' => $del_id))) {
			return $this->db->error();
		}
		return true;
	}
	public function deleteRecordByColoumn($tbl_name, $tbl_col, $value) {
		$this->db->delete($tbl_name, array($tbl_col => $value));
		return true;
	}
	public function recordDBCheck($del_id, $chkDB, $chkDBAtrr) {
		$query = $this->db->get_where($chkDB, array($chkDBAtrr => $del_id));
		return $query->row_array();
	}
	public function getImageNameById($del_id, $tbl_name) {
		$query = $this->db->get_where($tbl_name, array('id' => $del_id));
		return $query->row_array();
	}
	public function delImage($folderName, $imageName) {
		unlink(IMG_UPLOAD_PATH . $folderName . '/' . $imageName);
	}
	public function delFile($folderName, $fileName) {
		unlink('./assets/upload/' . $folderName . '/' . $fileName);
	}
	public function delImageFromGallery($folderName, $imageName) {
		unlink('./assets/upload/gallery/' . $folderName . '/' . $imageName);
	}
	public function getRecordById($id, $tbl_name) {
		$query = $this->db->get_where($tbl_name, array('id' => $id));
		return $query->row_array();
	}
	public function getRecordByColoumn($tbl_name, $tbl_col, $value) {
		$query = $this->db->get_where($tbl_name, array($tbl_col => $value));
		return $query->row_array();
	}
	public function getAllRecordByColoumn($tbl_name, $tbl_col, $value) {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get_where($tbl_name, array($tbl_col => $value));
		return $query->result_array();
	}
	public function getAllRecord($tbl_name) {

		$this->db->order_by('id', 'desc');
		if ($_SESSION['tbl_role_id'] != 1) {
			$this->db->where('add_by', $_SESSION['user_id']);}
		$query = $this->db->get($tbl_name);
		return $query->result_array();
	}
	public function getAllRecords($tbl_name) {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($tbl_name);
		return $query->result_array();
	}

	public function fetchDistrictByProvinceID($tbl_province_id) {
		$this->db->select('*');
		$this->db->from('tbl_district');
		$this->db->where('tbl_province_id', $tbl_province_id);
		$this->db->where('status', '1');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function fetchTehsilByDistrictID($tbl_district_id) {
		$this->db->select('*');
		$this->db->from('tbl_tehsil');
		$this->db->where('tbl_district_id', $tbl_district_id);
		$this->db->where('status', '1');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getProprietor($id) {
		$this->db->from('tbl_proprietor');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function getPharmacist($pharmacistData) {
		$this->db->from('tbl_pharmacist');
		$this->db->where('is_kp_province', 'yes');
		$this->db->where('pharmacy_reg_no', $pharmacistData);
		$query = $this->db->get();
		return $query->row();
	}

	public function getOtherPharmacist($pharmacistData) {
		$this->db->from('tbl_pharmacist');
		$this->db->where('is_kp_province', 'no');
		$this->db->where('pharmacy_reg_no', $pharmacistData);
		$query = $this->db->get();
		return $query->row();
	}

	// Get DataTable data
	function get_form_report($postData = null) {

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
		$tbl_form_type_id = $postData['tbl_form_type_id'];

		$tbl_district_id = $postData['tbl_district_id'];
		$status = $postData['status'];
		$tracking_code = $postData['tracking_code'];

		## Search
		$search_arr = array();
		$searchQuery = "";

		if ($from_date != '' && $to_date != '') {
			$from_date = date('Y-m-d', strtotime($postData['from_date']));
			$to_date = date('Y-m-d', strtotime($postData['to_date']));
			$search_arr[] = " record_add_date BETWEEN '" . $from_date . "' and '" . $to_date . "' ";

		}
		if ($status != '') {
			$search_arr[] = " status like '%" . $status . "%' ";
		}
		if ($tracking_code != '') {
			$search_arr[] = " tracking_code like '%" . $tracking_code . "%' ";
		}

		if ($tbl_district_id != '') {
			$search_arr[] = " tbl_district_id like '%" . $tbl_district_id . "%' ";
		}
		if ($tbl_form_type_id != '') {
			$search_arr[] = " tbl_form_type_id like '%" . $tbl_form_type_id . "%' ";
		}
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////

		## Total number of records without filtering
		$records = $this->db->query('SELECT count(*) AS allcount FROM
			(
        SELECT * FROM tbl_form_8a
        UNION ALL
        SELECT * FROM tbl_form_8b
        UNION ALL
        SELECT * FROM tbl_form_8c
        UNION ALL
        SELECT * FROM tbl_form_8d
    		) as tmp')->result();

		$totalRecords = $records[0]->allcount;
//////////////////////////////////////////////////////////////////////////////////////////////////////
		## Total number of record with filtering
		if ($searchQuery != '') {
			$records = $this->db->query('SELECT count(*) AS allcount FROM
			(
        SELECT * FROM tbl_form_8a
        UNION ALL
        SELECT * FROM tbl_form_8b
        UNION ALL
        SELECT * FROM tbl_form_8c
        UNION ALL
        SELECT * FROM tbl_form_8d
    		) as tmp where' . $searchQuery)->result();

		}
		$totalRecordwithFilter = $records[0]->allcount;

//////////////////////////////////////////////////////////////////////////////////////////////////////
		## Fetch records
		$this->db->select('*');
		$this->db->from("tbl_form_8a");
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$records1 = $this->db->get_compiled_select();
		//////////////////////////////////////////////

		$this->db->select('*');
		$this->db->from("tbl_form_8b");
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}

		$records2 = $this->db->get_compiled_select();
		//////////////////////////////////////////////

		$this->db->select('*');
		$this->db->from("tbl_form_8c");
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}

		$records3 = $this->db->get_compiled_select();
		//////////////////////////////////////////////

		$this->db->select('*');
		$this->db->from("tbl_form_8d");
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$this->db->order_by('id', 'desc');
		$records4 = $this->db->get_compiled_select();
		//////////////////////////////////////////////

		$records = $this->db->query($records1 . " UNION All " . $records2 . " UNION All " . $records3 . " UNION All " . $records4)->result();

		$data = array();
		$i = 1;
		foreach ($records as $record) {

			$getProprietor = $this->global->getRecordByArray($tbl_name = 'tbl_proprietor', array('id' => $record->tbl_proprietor_id));
			$getDistrict = $this->global->getRecordByArray($tbl_name = 'tbl_district', array('id' => $record->tbl_district_id));
			$applicationDate = date('d-m-Y', strtotime($record->record_add_date));
			if ($record->dg_approval_date) {
				$approvalDate = date('d-m-Y', strtotime($record->dg_approval_date));
			} else { $approvalDate = "N/A";}

			if ($record->status == 2) {
				$status = '<span class="label label-primary">Pending/ Inprocess</span>';
			} else if ($record->status == 1) {
				$status = '<span class="label label-success">Approve for Inspection</span>';
			} else if ($record->status == 0) {
				$status = '<span class="label label-danger">Rejected / Not Approved</span>';
			} else if ($record->status == 4) {
				$status = '<span class="label label-success">Approved</span>';}

			$getFormType = $this->global->getRecordById($id = $record->tbl_form_type_id, $tbl_name = 'tbl_form_type');

			$getInspection = $this->global->getRecordByArray($tbl_name = 'tbl_inspection', array('tbl_name' => $getFormType['db_tbl_name'], 'tbl_name_id' => $record->id));
			$getInspector = $this->global->getRecordByArray($tbl_name = 'tbl_user', array('id' => $getInspection['inspector_id']));
			if ($getInspection['inspection_date']) {
				$inspectionDate = date('d-m-Y', strtotime($getInspection['inspection_date']));
			} else { $inspectionDate = 'Not Inspected';}

			$data[] = array(
				"no" => $i,
				"formType" => $getFormType['name'],
				"proprietor" => $getProprietor['name'],
				"businessName" => $getProprietor['business_name'],
				"district" => $getDistrict['name'],
				"applicationDate" => $applicationDate,
				"approvalDate" => $approvalDate,
				"inspector" => $getInspector['name'],
				"inspectionDate" => $inspectionDate,
				"trackingCode" => $record->tracking_code,
				"status" => $status,
			);
			$i++;
		} //$records for each end

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
		);

		return $response;

		// } // foreach end

	} //function get_form_report end
}
?>