<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder_admin extends CI_Controller{

		public function __construct(){
			parent::__construct();
			if (!($this->session->userdata('username'))){ redirect('login');}
			$this->load->model('user_model');
			$this->load->model('report_model');
			$this->load->model('folder_model');
		}

		public function checkIfLogin(){
			if ($this->session->userdata('username')){
				echo 'true';
			} else {
				echo 'false';
			}
		}

		public function index(){
			$data['title'] = 'Administrator';
			$data['header'] = 'active'; 

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/home', $data);
			$this->load->view('admin/templates/footer');
		}

		public function reports(){
			$data['title'] = 'Reports';
			$data['report'] = 'active';
			$data['reports'] = $this->report_model->getAllUnreadReports();

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/reports', $data);
			$this->load->view('admin/templates/footer');
		}

		public function setForm_user($id = NULL){
			$data['title'] = 'Add User';
			$data['label'] = 'Add User';
			$data['form'] = 'active';
			$data['btn'] = 'ADD USER';
			$data['icon'] = 'fa fa-user-plus';
			$data['user'] = NULL;

			if (isset($id)){
				$data['title'] = 'Edit User';
				$data['label'] = 'Edit User';
				$data['btn'] = 'UPDATE USER';
				$data['icon'] = 'fa fa-pencil-square-o';
				$data['user'] = $this->user_model->getUserByUserID($id);
			}

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/add_user', $data);
			$this->load->view('admin/templates/footer');
		}

		public function manage_users(){
			$data['title'] = 'Manage Users';
			$data['users'] = $this->user_model->getAllUsers();
			$data['manage_users'] = 'active';

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/manage_users', $data);
			$this->load->view('admin/templates/footer');
		}

		public function manage_folders(){
			$data['title'] = "Manage Folders";
			$data['manage_folders'] = 'active';
			$data['folders'] = $this->folder_model->getAllFolders();

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/manage_folders', $data);
			$this->load->view('admin/templates/footer');
		}

		public function create_user(){
			$generated_id = sha1($this->input->post('txtUsername'));
			$usertype = $this->input->post('cboUserType')=='administrator'?'1':'2';
			$password = sha1($this->input->post('txtPassword'));

			$data = array(
					'user_id' => $generated_id,
					'username' => $this->input->post('txtUsername'),
					'user_type' => $usertype,
					'password' => $password,
					'email' => $this->input->post('txtEmail')
			);

			$this->user_model->addUser($data);
			$this->session->set_flashdata("message", "<strong><u>".$this->input->post('txtUsername')."</u></strong> has been successfully added.");
			redirect('administrator/accounts/manage');
		}

		public function update_user($id){
			$usertype = $this->input->post('cboUserType')=='administrator'?'1':'2';
			$password = $this->input->post('txtPassword');
			$old_password = $this->user_model->getUserByUserID($id)['password'];

			if ($old_password == $password){
				$password = $old_password;
			} else {
				$password = sha1($this->input->post('txtConfirmPassword'));
			}

			$data = array(
					'username' => $this->input->post('txtUsername'),
					'user_type' => $usertype,
					'password' => $password,
					'email' => $this->input->post('txtEmail')
			);

			$this->user_model->updateUser($id, $data);
			$this->session->set_flashdata("message", "<strong><u>".$this->input->post('txtUsername')."</u></strong> has been successfully updated.");
			redirect('administrator/accounts/manage');
		}

		public function delete_user($id){
			$this->session->set_flashdata("message", "<strong><u>".$this->user_model->getUserByUserID($id)['username']."</u></strong> has been successfully deleted.");
			$this->user_model->deleteUser($id);
        	redirect('administrator/accounts/manage');
		}

		public function ban_user($id){
			$user = $this->user_model->getUserByUserID($id);
			$data = null;
			
			if ($user['user_status'] == '1'){
				$data = array('user_status' => '0');
				$this->session->set_flashdata("message", "<strong><u>".$user['username']."</u></strong> has been successfully banned.");
			} else {
				$data = array('user_status' => '1');
				$this->session->set_flashdata("message", "<strong><u>".$user['username']."</u></strong> has been successfully unbanned.");
			}
			$this->user_model->updateUser($id, $data);
			redirect('administrator/accounts/manage');
		}

		public function reset_password($id){
			$user = $this->user_model->getUserByUserID($id);
			//$data = crc32(str);
			$this->session->set_flashdata("message", "<strong><u>".$user['username']."'s password</u></strong> has been successfully reset.");
			redirect('administrator/accounts/manage');
		}

		public function read($id){
			$data = array('report_status', '0');
			$this->report_model->updateReport($id, $data);
			echo "read";
		}
	}