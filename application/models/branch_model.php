<?php
	class branch_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->table = 'branches';
		}

		public function addBranch($data){
			$this->db->insert($this->table, $data);
		}
	}