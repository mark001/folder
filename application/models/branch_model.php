<?php
	class branch_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->table = 'branches';
		}

		public function addBranch($data){
			$this->db->insert($this->table, $data);
		}

		public function getBranchFolderByBranchName($folder_id, $branchname){
			$where_clause = array('folder_id' => $folder_id, 'branch_name' => $branchname);
			return $this->db->from($this->table)->where($where_clause)->get()->row_array();
		}

		public function getAllBranches($user_id, $folder_id){
			return $this->db->where('folder_id', $folder_id)->order_by('branch_name', 'asc')->get($this->table)->result_array();
		}
	}