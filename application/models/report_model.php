<?php
	class report_model extends CI_Model {
		
		public function __construct(){
			parent::__construct();
			$this->table = 'reports';
		}

		public function addReport($data){
			$this->db->insert($this->table, $data);
		}

		public function updateReport($id, $data){
			$this->db->where('report_id', $id)->update($this->table, $data);
		}

		public function getReport($id){
			return $this->db->from($this->table)->where('report_id', $id)->get()->row_array();
		}

		public function getAllReports(){
			return $this->db->order_by('report_date', 'asc')->get($this->table)->result_array();
		}

		public function getAllUnreadReports(){
			return $this->db->where('report_status', '1')->order_by('report_date', 'asc')->get($this->table)->result_array();
		}

		public function getNumberOfUnreadReports(){
			return $this->db->from($this->table)->where('report_status', '1')->count_all_results();
		}
	}