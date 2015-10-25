<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model('user_model');
		}

		public function index(){
			$this->load->view('login');
		}

		public function sign_up(){
			$this->load->view('signup');
		}


		public function error404(){
			$this->load->view('404');
		}

		public function password_reset(){
			$this->load->view('password_reset');
		}

		public function login(){
			$users = $this->user_model->getAllUsers();
			$username = $this->input->post('txtUsername');
			$password = sha1($this->input->post('txtPassword'));
			$loginUser = null;

			foreach($users as $user){
				if (($user['username'] == $username) && ($user['password'] == $password) && ($user['user_status'] == '1')){
					$loginUser = $this->user_model->getUserByUsername($username);
					break;
				} else if (($user['email'] == $username) && ($user['password'] == $password) && ($user['user_status'] == '1')){
					$loginUser = $this->user_model->getUserByEmail($username);
					break;
				}
			}

			if (isset($loginUser)){
				$this->session->set_userdata($loginUser);

				if ($loginUser['user_type'] == '1'){
					redirect('administrator');
				} else {
					redirect('home');
				}
			} else {
				$this->session->set_flashdata("message", "Username or password is incorrect.");
				redirect('login');
			}
		}

		public function logout()
		{
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_type');
			$this->session->unset_userdata('email');	
			redirect('login');
		}

		public function check_user_username($username){
			$exist = false;
			$users = $this->user_model->getAllUsers();
			$username = urldecode($username);
			
			foreach($users as $user){
				if ($user['username'] == $username){
					$exist = true;
					break;
				}
			}

			echo $exist;
		}

		public function check_user_email($email){
			$exist = false;
			$users = $this->user_model->getAllUsers();
			$email = urldecode($email);

			foreach($users as $user){
				if ($user['email'] == $email){
					$exist = true;
					break;
				}
			}

			echo $exist;
		}

		public function create_user(){
			$generated_id = sha1($this->input->post('txtUsername'));
			$password = sha1($this->input->post('txtPassword'));

			$data = array(
					'user_id' => $generated_id,
					'username' => $this->input->post('txtUsername'),
					'user_type' => '2',
					'password' => $password,
					'email' => $this->input->post('txtEmail')
			);

			$this->user_model->addUser($data);
			$this->session->set_flashdata("message", "You have successfully sign up! Login with your account now.");
			redirect('login');
		}
	}