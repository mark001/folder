<?php
	class folder_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->table = 'folders';
		}

		public function addFolder($data){
			$this->db->insert($this->table, $data);
		}

		public function updateFolder($id, $data){
			$this->db->where('folder_id', $id)->update($this->table, $data);
		}

		public function deleteFolder($id, $data){
			$this->db->delete($this->table, array('user_id' => $id));
		}

		public function getAllFolders($order = NULL){
			if (empty($order)){
				return $this->db->order_by('folder_name', 'asc')->get($this->table)->result_array();
			} else {
				return $this->db->order_by('folder_update', 'desc')->get($this->table)->result_array();
			}
		}

		public function getAllMyFolders($id, $order = NULL){
			if (empty($order)){
				return $this->db->where('user_id', $id)->order_by('folder_name', 'asc')->get($this->table)->result_array();
			} else {
				return $this->db->where('user_id', $id)->order_by('folder_update', 'asc')->get($this->table)->result_array();
			}	
		}

		public function getAllPublicFolders($order = NULL){
			if (empty($order)){
				return $this->db->where('folder_access', '0')->order_by('folder_name', 'asc')->get($this->table)->result_array();
			} else {
				return $this->db->where('folder_access', '0')->order_by('folder_update', 'asc')->get($this->table)->result_array();
			}	
		}

		public function getFolderByFolderID($id){
			return $this->db->from($this->table)->where('folder_id', $id)->get()->row_array();
		}

		public function getFolderByFolderName($folderName){
			return $this->db->from($this->table)->where('folder_name', $folderName)->get()->row_array();	
		}
	}