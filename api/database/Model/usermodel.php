<?php
	class user_model{
		//the database connection variable
		private $con;

		//inside constructor
		//we are getting the connection link
		function __construct() {
			require_once dirname(dirname(__FILE__)) . '/db-connect.php';
			$db = new DbConnect;
			$this->con = $db->connect();
		}
		public function login($data = array())
		{
			$result = array();
			$sql = "SELECT * FROM user WHERE mail_id='".$data['usermail']."'";
			$output = $this->con->query($sql);
			
			if($output){
				if ($output->num_rows > 0) {
					// output data of each row
					while($row = $output->fetch_assoc()) {
						$result['is_valid']=false;
						if (md5($data['password'] . $row['token']) == $row['password']) {
							$result['is_valid']=true;
							$result['user_data'] = $row;
							return $result;			 	
						}
					}
					return $result;
				} else {
					return null;
				}
			} else {
				return null;
			}
		}

		public function get_user($data = array()){
			$sql = "SELECT * FROM user";

			if (isset($data['user_id']) && ($data['user_id'] > 0)) {
				$sql .= " WHERE uid=".$data['user_id'];
			}

			$result = $this->con->query($sql);
			//return $sql;
			if($result){
				if ($result->num_rows > 0) {
					// output data of each row
					$user = array();
					while($row = $result->fetch_assoc()) {
						$user=$row;
					}
					return $user;
				} else {
					return null;
				}
			} else{
				return null;
			}
		}

		public function add_user($data){

			$result = array();
			$password = $data['password'];
			$token = bin2hex(random_bytes(32));
			$hash_password=md5($data['password'].$token);

			//Adding User
			$sql = "INSERT INTO user SET uname='".$data['username']."', password='".$hash_password."', token='".$token."', mail_id='".$data['mail_id']."'";
			

			$output = $this->con->query($sql);

			$user_id = $this->con->insert_id;

			if($user_id){
				$result=array();
				$result['is_added'] = true;
				$result['employee_id'] = $user_id;
				$result['user_details']=array(
					'user_id'		=> $user_id,
					'user_name'		=> $data['username'],
					'mail_id'		=> $data['mail_id'],
				);
				return $result;
			}else{
				return null;
			}
		}
	}
