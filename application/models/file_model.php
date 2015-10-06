<?php
	class file_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->table = 'files';
		}

		public function addFile($data){
			$this->db->insert($this->table, $data);
		}	

		public function updateFile($id, $data){
			$this->db->where('file_id', $id)->update($this->table, $data);
		}

		public function deleteFile($id){
			$this->db->delete($this->table, array('file_id' => $id));
		}

		public function getFilesUserFolderBranchByBranchID($branch_id){
			return $this->db->where('branch_id', $branch_id)->get($this->table)->result_array();
		}

		public function getFileByFileName($branch_id, $filename){
			$where_clause = array('branch_id'=> $branch_id, 'file_name' => $filename);
			return $this->db->from($this->table)->where($where_clause)->get()->row_array();
		}

		/*public function getFileByID($id){
			return $this->db->from($this->table)->where('file_id', $id)->get()->row_array();
		}

		public function getFileByFileName($filename){
			return $this->db->from($this->table)->where('file_name', $filename)->get()->row_array();
		}

		public function getFileByFileName($branch_id, $filename){
			$where_clause = array('branch_id' => $branch_id, 'file_name' => $filename);
			return $this->db->from($this->table)->where($where_clause)->get()->row_array();	
		}

		public function getAllFiles(){
			return $this->db->get($this->table)->result_array();
		}*/
	}