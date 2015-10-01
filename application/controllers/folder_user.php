<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder_user extends CI_Controller{

		public function __construct(){
			parent::__construct();
			if (!($this->session->userdata('username'))){ redirect('login');}
			$this->load->model('user_model');
			$this->load->model('report_model');
			$this->load->model('folder_model');
			$this->load->model('branch_model');
		}

		public function index(){
			$data['title'] = "Organize your codes.";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/home', $data);
			$this->load->view('user/templates/footer');
		}

		public function profile($id){
			$data['title'] = "My Profile";
			$data['user'] = $this->user_model->getUserByUserID($id);

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/profile', $data);
			$this->load->view('user/templates/footer');	
		}

		public function my_folders($username){
			$user = $this->user_model->getUserByUsername(urldecode($username));
			$data['title'] = "My Folders";
			$data['folders'] = $this->folder_model->getAllMyFolders($user['user_id']);

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/myfolders', $data);
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

		public function report(){
			$data = null;
			$reportType = $this->input->post('reportType');

			$config['upload_path'] = './upload/screenshot/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '500';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('imgScreenShot')){
				if ($reportType == '1'){
					$data = array(
						'report_intensity' => $this->input->post('cboIntensity'),
						'report_details' => $this->input->post('txtDetails'),
						'screenshot' => $this->upload->data()['full_path'],
						'report_type' => $reportType,
						'user_id' => $this->session->userdata('user_id')
					);
				} else if ($reportType == '2'){
					$data = array(
						'report_details' => $this->input->post('txtDetails'),
						'screenshot' => $this->upload->data()['full_path'],
						'report_type' => $reportType,
						'user_id' => $this->session->userdata('user_id')
					);
				} 
			} else {
				echo $this->upload->display_errors();
				echo "Error sending report!";
				exit;
			}

			$this->report_model->addReport($data);
			$this->session->set_flashdata("message", "Report has been successfully sent! Thank you for your contribution!");
			redirect('home');
		}

		public function createNewFolder(){
			$generated_folderID = sha1($this->input->post("txtFolderAuthor").$this->input->post("txtFolderName"));
			$data_folder = array(
				'folder_id' => $generated_folderID,
				'folder_name' => $this->input->post("txtFolderName"),
				'folder_access' => $this->input->post("accessLevel"),
				'folder_type' => $this->input->post("optType"),
				'folder_details' => $this->input->post("txtDescription"),
				'user_id' => $this->session->userdata('user_id')
			);
			$data_branch = array('folder_id' => $generated_folderID, 'user_id' => $this->session->userdata('user_id'));
			$this->folder_model->addFolder($data_folder);
			$this->branch_model->addBranch($data_branch);

			$this->session->set_flashdata("message", "<strong>".$this->input->post("txtFolderName")."</strong> has been successfully created!");
			redirect('folder/'.$this->session->userdata('username'));
		}
	}