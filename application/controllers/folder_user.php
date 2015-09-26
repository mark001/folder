<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder_user extends CI_Controller{

		public function index(){
			$data['title'] = "Organize your codes.";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/home', $data);
			$this->load->view('user/templates/footer');
		}

		public function my_folders(){
			$data['title'] = "My Folders";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/myfolders');
			$this->load->view('user/templates/footer');	
		}

		public function new_folder(){
			$data['title'] = "New Folder";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/newfolder');
			$this->load->view('user/templates/footer');	
		}

		public function other_folders(){
			$data['title'] = "Other Folders";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/otherfolders');
			$this->load->view('user/templates/footer');		
		}

		public function feedback(){
			$data['title'] = "Feedback";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/feedback');
			$this->load->view('user/templates/footer');		
		}

		public function source(){
			$data['title'] = "Folder Name";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/source');
			$this->load->view('user/templates/footer');	
		}
	}