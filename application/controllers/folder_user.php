<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class folder_user extends CI_Controller{

		public function __construct(){
			parent::__construct();
			if (!($this->session->userdata('username')) && $this->session->userdata('user_type') == '2'){ redirect('login');}
			$this->load->model('user_model');
			$this->load->model('report_model');
			$this->load->model('folder_model');
			$this->load->model('branch_model');
			$this->load->model('file_model');
			$this->load->model('push_model');
		}

		public function index(){
			$data['title'] = "Organize your codes.";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/home', $data);
			$this->load->view('user/templates/footer');
		}

		public function profile($username){
			$data['title'] = "My Profile";
			$data['user'] = $this->user_model->getUserByUsername(urldecode($username));

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/profile', $data);
			$this->load->view('user/templates/footer');	
		}

		public function my_folders($username){
			$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
			$data['title'] = "My Folders";
			$data['folders'] = $this->folder_model->getAllMyFolders($id);

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
			$data['folders'] = $this->folder_model->getAllPublicFolders();
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/otherfolders', $data);
			$this->load->view('user/templates/footer');		
		}

		public function feedback(){
			$data['title'] = "Feedback";
			
			$this->load->view('user/templates/header', $data);
			$this->load->view('user/feedback');
			$this->load->view('user/templates/footer');		
		}

		public function push_page($foldername){
			$folder = $this->folder_model->getFolderByFolderName($this->session->userdata('user_id'), urldecode($foldername));
			$data['title'] = "Push";
			$data['folder'] = $folder;
			$data['branches'] = $this->branch_model->getAllBranches($folder['folder_id']);

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/push', $data);
			$this->load->view('user/templates/footer');
		}

		public function source_main($username, $foldername){
			$user = $this->user_model->getUserByUsername(urldecode($username));
			$folder = $this->folder_model->getFolderByFolderName($user['user_id'], urldecode($foldername));
			$branches = $this->branch_model->getAllBranches($folder['folder_id']);
			$data['title'] = $folder['folder_name'];
			$data['user'] = $user;
			$data['folder'] = $folder;
			$data['branches'] = $branches;
			$data['branch_count'] = count($branches);
			$data['push_count'] = $this->push_model->getNumberOfPushByFolderID($folder['folder_id']);
			$countTotalFiles = 0;
			foreach ($branches as $branch) {
				$countTotalFiles += $this->file_model->getNumberOfUserFolderBranchFilesByBranchID($branch['branch_id']);
			}
			$data['file_count'] = $countTotalFiles;

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/source_main', $data);
			$this->load->view('user/templates/footer');
		}

		public function source($username, $foldername, $branchname){
			$user = $this->user_model->getUserByUsername(urldecode($username));
			$folder = $this->folder_model->getFolderByFolderName($user['user_id'], urldecode($foldername));
			$data['title'] = $folder['folder_name'];
			$data['user'] = $user;
			$data['folder'] = $folder;
			$data['files'] = $this->file_model->getFilesUserFolderBranchByBranchID($this->branch_model->getBranchFolderByBranchName($folder['folder_id'], urldecode($branchname))['branch_id']);
			$data['branches'] = $this->branch_model->getAllBranches($folder['folder_id']);
			$data['branch_selected'] = urldecode($branchname);

			$this->load->view('user/templates/header', $data);
			$this->load->view('user/source');
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

			$generated_BranchId = sha1($this->input->post("txtFolderAuthor").$this->input->post("txtFolderName")."master");
			$data_branch = array('branch_id' => $generated_BranchId, 'folder_id' => $generated_folderID);
			$this->folder_model->addFolder($data_folder);
			$this->branch_model->addBranch($data_branch);
			$this->session->set_flashdata("message", "<strong>".$this->input->post("txtFolderName")."</strong> has been successfully created!");
			redirect('folder/'.$this->session->userdata('username'));
		}

		public function update_account_info($username){
			$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
			$data = array(
					'username' => $this->input->post('txtUsername'),
					'email' => $this->input->post('txtEmail')
			);

			$this->user_model->updateUser($id, $data);
			$this->session->set_flashdata("message", "You successfully updated your account information!");
			$this->session->set_userdata('username', $this->input->post('txtUsername'));
			$this->session->set_userdata('email', $this->input->post('txtEmail'));
			redirect('profile/'.$this->session->userdata('username'));
		}

		public function change_password($username){
			$current_password = sha1($this->input->post('txtCurrentPassword'));
			
			if ($current_password == $this->session->userdata('password')){
				$id = $this->user_model->getUserByUsername(urldecode($username))['user_id'];
				$newpassword = sha1($this->input->post('txtNewPassword'));
				$data = array('password' => $newpassword);
				$this->user_model->updateUser($id, $data);
				$this->session->set_flashdata("message", "You successfully change your password!");
				$this->session->set_userdata('password', $newpassword);
			} else {
				$this->session->set_flashdata("message", "There was an error changing your password");
			}

			redirect('profile/'.$this->session->userdata('username'));
		}

		public function push($foldername){
			 if(sizeof($_FILES) > 0){
			 	$foldername = urldecode($foldername);
			 	$folder_id = $this->folder_model->getFolderByFolderName($this->session->userdata['user_id'], $foldername)['folder_id'];
			 	$branchname = $_POST['branch'];
			 	$uploadPath = 'upload/'.$this->session->userdata('user_id').'/'.$foldername.'/'.$_POST['branch'].'/';
				
				$this->deleteFilesNotExist($this->branch_model->getBranchFolderByBranchName($folder_id, $branchname)['branch_id'], $uploadPath);
				$this->prepareUpload($_FILES, $uploadPath, $this->branch_model->getBranchFolderByBranchName($folder_id, $branchname)['branch_id']);
					$data = array ('folder_id' => $folder_id);
				$this->push_model->addPush($data);
			}
		}

		public function createBranch(){
			$generated_BranchId = sha1($this->input->post("folderAuthor").$this->input->post("txtFolderName").$this->input->post("txtBranchName"));
			$folder_id = $this->folder_model->getFolderByFolderName($this->user_model->getUserByUsername($this->input->post("folderAuthor"))['user_id'], $this->input->post("txtFolderName"))['folder_id'];
			$data_branch = array('branch_id' => $generated_BranchId, 'branch_name' => $this->input->post("txtBranchName"), 'folder_id' => $folder_id);
			$this->branch_model->addBranch($data_branch);
			//$this->session->set_flashdata("message", "<strong>".$this->input->post("txtBranchName")."</strong> has been successfully created!");
			redirect('folder/'.$this->input->post("folderAuthor") .'/'. $this->input->post("txtFolderName") .'/'. $this->input->post("txtBranchName"));	
		}

		private function prepareUpload($uploads, $uploadDir, $branch_id){

			$paths = explode("###",rtrim($_POST['paths'],"###"));
			
			// Loop through files sent
			foreach($uploads as $key => $current)
			{
				// Stores full destination path of file on server
				$this->uploadFile= $uploadDir.rtrim($paths[$key],"/.");
				
				// Stores containing folder path to check if dir later
				$this->folder = substr($this->uploadFile, 0, strrpos($this->uploadFile,"/"));
				
				// Check whether the current entity is an actual file or a folder (With a . for a name)
				if(strlen($current['name']) != 1){
					$this->upload($current, $this->uploadFile, $branch_id);
				}
			}
		}

		private function upload($current, $uploadFile, $branch_id){
			$successful = false;

			//get the file in the database
			$file = $this->file_model->getFileByFileName($branch_id, $current['name']);


			//checks if file is in the database or not
			if (empty($file)){
				// Checks whether the current file's containing folder exists, if not, it will create it.
				if(!is_dir($this->folder)){
					mkdir($this->folder, 0700, true);
				}

				// Moves current file to upload destination
				if(move_uploaded_file($current['tmp_name'], $uploadFile)){	
					$data = array(
						'file_name' => basename($uploadFile),
						'file_size' => filesize(realpath($uploadFile)),
						'file_type' => pathinfo(basename($uploadFile), PATHINFO_EXTENSION),
						'file_path' => realpath($uploadFile),
						'commit_message' => $_POST['commit_message'],
						'branch_id' => $branch_id
					); //put detail of data

					$this->file_model->addFile($data);
					$successful = true; //return true if successful move
					echo basename($uploadFile) . " is added!\n";
				} else {			
					$successful = false; //return false if unsuccessful
				}

			} else {
				//checks if the file size is the same or not
				if ($file['file_size'] != $current['size']){
					
					$data = array(
						'file_size' => filesize(realpath($uploadFile)),
						'commit_message' => $_POST['commit_message'],
					); //put detail of data

					$this->file_model->updateFile($file['file_id'], $data);
					echo $file['file_name'] . " is updated!\n";
					$successful = true; // return true if the same
				}
			}

			return $successful;
		}

		private function deleteFilesNotExist($branch_id, $uploadPath){
			$files = $this->file_model->getFilesUserFolderBranchByBranchID($branch_id);
			$paths = explode("###",rtrim($_POST['paths'],"###"));

			$arrayLength = count($files)>count($paths)?count($paths):count($files);

			if ($files != null){
				for ($i = 0; $i < $arrayLength; $i++){
					if ($this->getFile($files[$i]['file_path']) != $this->getFile($uploadPath.$paths[$i])){
						$this->file_model->deleteFile($files[$i]['file_id']);
						unlink($files[$i]['file_path']);
						echo $files[$i]['file_name'] . " is deleted!\n";
						//echo $this->getFile($files[$i]['file_path']) . " != " . $this->getFile($uploadPath.$paths[$i]);
					}
				}
			}
		}

		private function getFile($filepath){
			$filepath = str_replace("\\", '/', $filepath);
			$filepaths = explode('upload/', $filepath, 2);
			return $filepaths[1];
		}

		public function encryptPassword(){
			echo sha1($this->input->post('current'));
		}

		public function checkBranch(){
			$user_id = $this->user_model->getUserByUsername($this->input->post('username'))['user_id'];
			$folder_id = $this->folder_model->getFolderByFolderName($user_id, $this->input->post('folderName'))['folder_id'];
			$branch = $this->branch_model->getBranchFolderByBranchName($folder_id, $this->input->post('branchName'));

			if (!empty($branch)){
				echo "1";
			} else {
				echo "0";
			}
		}

		public function checkFolder(){
			$user_id = $this->session->userdata('user_id');
			$folder = $this->folder_model->getFolderByFolderName($user_id, $this->input->post('txtFolderName'));

			if (!empty($folder)){
				echo "1";
			} else {
				echo "0";
			}
		}

		public function deleteFolder($foldername){
			$user_id = $this->session->userdata('user_id');
			$folder_id = $this->folder_model->getFolderByFolderName($user_id, urldecode($foldername))['folder_id'];
			$dir = 'C:\\xampp\\htdocs\\folder\\upload\\'.$user_id.'\\'.urldecode($foldername);

			delete_files($dir, TRUE);

			redirect('folder/'.$this->session->userdata('username'));
		}

		public function changeAccess($foldername){
			$user_id = $this->session->userdata('user_id');
			$folder = $this->folder_model->getFolderByFolderName($user_id, urldecode($foldername));	
			$data = null;

			if ($folder['folder_access'] == '1'){
				$data = array('folder_access' => '0');
			} else {
				$data =  array('folder_access' => '1');
			}

			$this->folder_model->updateFolder($folder['folder_id'], $data);
			redirect('folder/'.$this->session->userdata('username'));
		}

		public function create_zip($username, $foldername, $branchname){
			$user_id = $this->user_model->getUserByUsername($username)['user_id'];

			$path = "C:../xampp/htdocs/folder/upload/".$user_id.'/'.urldecode($foldername).'/'.$branchname. '/';
			$this->zip->read_dir($path, false);
			$this->zip->download($foldername);
		}

		public function download_folder($foldername){
			$url = "http://localhost/".urldecode($foldername).'.zip';
			$zipFile = "C:/xampp/htdocs/hi.zip";
			
			$zipResource = fopen($zipFile, "w");
			// Get The Zip File From Server
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_FILE, $zipResource);
			$page = curl_exec($ch);
			
			if(!$page) {
			 echo "Error :- ".curl_error($ch);
			}
			curl_close($ch);

			$zip = new ZipArchive;
			$extractPath = 'C:/xampp/htdocs/unzip/';
			
			if($zip->open($zipFile) != "true"){
			 echo "Error :- Unable to open the Zip File";
			} else {
				/* Extract Zip File */
				$zip->extractTo($extractPath);
				$zip->close();
				echo 'Done';
			}
		}
	}