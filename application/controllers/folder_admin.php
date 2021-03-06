<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder_admin extends CI_Controller{

		public function __construct(){
			parent::__construct();
			if (!($this->session->userdata('username')) && $this->session->userdata('user_type') == '1'){ redirect('login');}
			$this->load->model('user_model');
			$this->load->model('report_model');
			$this->load->model('folder_model');
		}

		public function index(){
			$data['title'] = 'Administrator';
			$data['header'] = 'active';
			$data['unread'] = $this->report_model->getNumberOfUnreadReports(); 
			$data['users'] = $this->user_model->getNumberOfUsers();
			$data['folders'] = $this->folder_model->getNumberOfFolders();

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/home', $data);
			$this->load->view('admin/templates/footer');
		}

		public function reports(){
			$data['title'] = 'Reports';
			$data['report'] = 'active';
			$data['reports'] = $this->report_model->getAllUnreadReports();
			$data['unread'] = $this->report_model->getNumberOfUnreadReports();

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/reports', $data);
			$this->load->view('admin/templates/footer');
		}

		public function setForm_user($username = NULL){
			$data['title'] = 'Add User';
			$data['label'] = 'Add User';
			$data['form'] = 'active';
			$data['btn'] = 'ADD USER';
			$data['icon'] = 'fa fa-user-plus';
			$data['user'] = NULL;
			$data['unread'] = $this->report_model->getNumberOfUnreadReports();

			if (isset($username)){
				$data['title'] = 'Edit User';
				$data['label'] = 'Edit User';
				$data['btn'] = 'UPDATE USER';
				$data['icon'] = 'fa fa-pencil-square-o';
				$data['user'] = $this->user_model->getUserByUsername(urldecode($username));
			}

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/add_user', $data);
			$this->load->view('admin/templates/footer');
		}

		public function manage_users(){
			$data['title'] = 'Manage Users';
			$data['users'] = $this->user_model->getAllUsers();
			$data['manage_users'] = 'active';
			$data['unread'] = $this->report_model->getNumberOfUnreadReports();

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/manage_users', $data);
			$this->load->view('admin/templates/footer');
		}

		public function manage_folders(){
			$data['title'] = "Manage Folders";
			$data['manage_folders'] = 'active';
			$data['folders'] = $this->folder_model->getAllFolders();
			$data['unread'] = $this->report_model->getNumberOfUnreadReports();

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

		public function update_user($username){
			$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
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
			$this->session->set_flashdata("message", "<strong><u>".urldecode($username)."</u></strong> has been successfully updated.");
			
			if ($id == $this->session->userdata('user_id')){
				$loginUser = $this->user_model->getUserByUserID($id);
				$this->session->set_userdata($loginUser);
			}

			redirect('administrator/accounts/manage');
		}

		public function delete_user($username){
			$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
			$this->session->set_flashdata("message", "<strong><u>".urldecode($username)."</u></strong> has been successfully deleted.");
			$this->user_model->deleteUser($id);
        	redirect('administrator/accounts/manage');
		}

		public function ban_user($username){
			$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
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

		public function reset_password($username){
			$user = $this->user_model->getUserByUsername(urldecode($username));
			//$data = crc32(str);
			$this->session->set_flashdata("message", "<strong><u>".$user['username']."'s password</u></strong> has been successfully reset.");
			redirect('administrator/accounts/manage');
		}

		public function read($id){
			$data = array('report_status' => '0');
			$this->report_model->updateReport($id, $data);
			echo "read";
		}
	}