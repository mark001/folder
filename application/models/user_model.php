<?php

	class user_model extends CI_Model{

		public function __construct(){
			parent::__construct();
        	$this->table = 'users';
        	$this->load->database();
		}

		public function addUser($data){
			$this->db->insert($this->table, $data);
		}

		public function updateUser($id, $data){
			return $this->db->where('user_id', $id)->update($this->table, $data);
		}

		public function deleteUser($id){
			return $this->db->delete($this->table, array('user_id' => $id));
		}

		public function getUserByUserID($id){
			return $this->db->from($this->table)->where('user_id', $id)->get()->row_array();
		}

		public function getUserByUsername($username){
			return $this->db->from($this->table)->where('username', $username)->get()->row_array();
		}

		public function getUserByEmail($email){
			return $this->db->from($this->table)->where('email', $email)->get()->row_array();
		}

		public function getAllUsers($username = NULL){
			return $this->db->order_by('username', 'asc')->get($this->table)->result_array();
		}
	}
