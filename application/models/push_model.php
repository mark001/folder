<?php
	
	class push_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->table = 'push';
		}

		public function addPush($data){
			$this->db->insert($this->table, $data);
		}

		public function getNumberOfPushByFolderID($id){
			return $this->db->from($this->table)->where('folder_id', $id)->count_all_results();
		}
	}