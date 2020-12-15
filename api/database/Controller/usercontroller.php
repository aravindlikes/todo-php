<?php
	class user_controller{

		private $user_model;

		function __construct() {
			require_once dirname(dirname(__FILE__)) . '/Model/usermodel.php';
			$this->user_model = new user_model;
		}

		function login($data = array()){
			$error=false;
			$error_msg = '';

			if (isset($data['usermail']) && isset($data['password'])) {
				$usermail = $data['usermail'];
				$password = $data['password'];
			} else {
				$error = true;
				$error_msg = "Missing Email or Password";
			}
			
			if($error){
				return array('error' => true, 'error_code' => '405', 'error_msg' => $error_msg);
			}else{
				$filter_data = array(
					'usermail'  	=> $usermail,
					'password'		=> $password
				);
			}

			$results = array();

			$results = $this->user_model->login($filter_data);

			if($results['is_valid']){
				$output = array();
				$user_status = $results['user_data']['user_status'];
				if($user_status){
					$user_status = 'active';
					$_SESSION["user_id"] = $results['user_data']['uid'];
				}else{
					$user_status = 'inactive';
				}
				$output=array(
					'error'			=> false,
					'user_id'		=> $results['user_data']['uid'],
					'username'		=> $results['user_data']['uname'],
					'mail-id'		=> $results['user_data']['mail_id'],
					'user_status'	=> $user_status,
					'joined_date'	=> $results['user_data']['joined_date'],
				);
				return $output;
			}else{
				$error_msg = "Check mail-id and Password.";
				return array('error' => true, 'error_code' => '405', 'error_msg' => $error_msg);
			}
		}
		public function get_user( $data = array()){
			$error=false;
			$error_msg = '';
			$filter_data = array();
			if( isset($data['user_id']) && $data['user_id'] !=""){
				$filter_data['user_id'] = $data['user_id'];
			}
			$results= $this->user_model->get_user($filter_data);
			if($results){
				$user_status = $results['user_status'];
				if($user_status){
					$user_status = 'active';
				}else{
					$user_status = 'inactive';
				}
				$output = array(
					'error'			=> false,
					'user_id'		=> $results['uid'],
					'username'		=> $results['uname'],
					'mail-id'		=> $results['mail_id'],
					'user_status'	=> $user_status,
					'joined_date'	=> $results['joined_date'],
				);
				return $output;
			}else{
				return array('error' => true, 'error_code' => '404', 'error_msg' => 'User Not Found.');
			}
		}
		public function add_user($data=array()){
			$error = false;
			$result = array();

			if ( isset($data['username']) && $data['username']!="" ) {
				$username = $data['username'];
			} else {
				$error = true;
				$result['is_error']=true;
				$result['error_msg']['username'] = "First name must be greater than 1 character";
			}

			if ( isset($data['mail_id']) && $data['mail_id']!="" ) {
				$mail_id = $data['mail_id'];
			} else {
				$error = true;
				$result['is_error']=true;
				$result['error_msg']['mail_id'] = "mail_id must be greater than 1 character";
			}

			if ( isset($data['password']) && isset($data['password'])!="" ) {
				$password = $data['password'];
			} else {
				$error = true;
				$result['is_error']=true;
				$result['error_msg']['password'] = "Password must be greater than 1 character and valid";
			}


			if($error){
				return $result;
			}else{
				$user_data=array(
					'username'		=> $username,
					'password'		=> $password,
					'mail_id'		=> $mail_id,
				);
				$output = $this->user_model->add_user($user_data);
				if($output['is_added']){
					return $output;
				}else{
					return array('error' => true, 'error_code' => '405', 'error_msg' => 'unable to save. Please try after some time');
				}
			}
		}
		public function logout_user($data = array()){
			if (isset($_SESSION["user_id"])) {
				unset($_SESSION["user_id"]);
				$msg = "User logged out successfully";
				return array('error' => false, 'msg' => $msg);
			} else {
				$error_msg = "User not logged in";
				return array('error' => true, 'error_code' => '405', 'error_msg' => $error_msg);
			}
		}

		public function login_check($data = array()){
			if (isset($_SESSION["user_id"])) {
				return $this->get_user($_SESSION);
			} else {
				$error_msg = "User not logged in";
				return array('error' => true, 'error_code' => '405', 'error_msg' => $error_msg);
			}
		}
	}