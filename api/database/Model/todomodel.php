<?php
	class todo_model{
		//the database connection variable
		private $con;

		//inside constructor
		//we are getting the connection link
		function __construct() {
			require_once dirname(dirname(__FILE__)) . '/db-connect.php';
			$db = new DbConnect;
			$this->con = $db->connect();
		}
		public function get_all_todo($data = array()){
			$sql = "SELECT * FROM todo";

			$where = null;

			if (isset($data['user_id']) && ($data['user_id'] > 0)) {
				if( $where == null ){
					$where .= " WHERE user_id=".$data['user_id'];
				}else{
					$where .= " AND user_id=".$data['user_id'];
				}

			}

			if (isset($data['todo_id']) && ($data['todo_id'] > 0)) {
				if( $where == null ){
					$where .= " WHERE todo_id=".$data['todo_id'];
				}else{
					$where .= " AND todo_id=".$data['todo_id'];
				}

			}
			$sql = $sql."".$where;
			$result = $this->con->query($sql);
			//return $sql;
			if($result){
				if ($result->num_rows > 0) {
					// output data of each row
					$user = array();
					while($row = $result->fetch_assoc()) {
						array_push($user,$row);
					}
					return $user;
				} else {
					return null;
				}
			} else{
				return null;
			}
		}
		public function get_overdue_todo($data = array()){
			$sql = "SELECT * FROM todo";
			$date = date("Y-m-d");
			$where = null;
			$where = " WHERE due_date < '".$date."'";

			if (isset($data['user_id']) && ($data['user_id'] > 0)) {
				if( $where == null ){
					$where .= " WHERE user_id=".$data['user_id'];
				}else{
					$where .= " AND user_id=".$data['user_id'];
				}

			}
			$sql = $sql."".$where." AND status=1";
			$result = $this->con->query($sql);
			if($result){
				if ($result->num_rows > 0) {
					// output data of each row
					$user = array();
					while($row = $result->fetch_assoc()) {
						array_push($user,$row);
					}
					return $user;
				} else {
					return null;
				}
			} else{
				return null;
			}
		}

		public function get_completed_todo($data = array()){
			$sql = "SELECT * FROM todo";
			$where = null;
			if (isset($data['user_id']) && ($data['user_id'] > 0)) {
				if( $where == null ){
					$where .= " WHERE user_id=".$data['user_id'];
				}else{
					$where .= " AND user_id=".$data['user_id'];
				}

			}
			$sql = $sql."".$where." AND status=2";
			$result = $this->con->query($sql);
			if($result){
				if ($result->num_rows > 0) {
					// output data of each row
					$user = array();
					while($row = $result->fetch_assoc()) {
						array_push($user,$row);
					}
					return $user;
				} else {
					return null;
				}
			} else{
				return null;
			}
		}

		public function get_pending_todo($data = array()){
			$sql = "SELECT * FROM todo";
			$where = null;
			if (isset($data['user_id']) && ($data['user_id'] > 0)) {
				if( $where == null ){
					$where .= " WHERE user_id=".$data['user_id'];
				}else{
					$where .= " AND user_id=".$data['user_id'];
				}

			}
			$sql = $sql."".$where." AND status=1";
			$result = $this->con->query($sql);
			if($result){
				if ($result->num_rows > 0) {
					// output data of each row
					$user = array();
					while($row = $result->fetch_assoc()) {
						array_push($user,$row);
					}
					return $user;
				} else {
					return null;
				}
			} else{
				return null;
			}
		}

		public function add_todo($data){
			$user_id = $_SESSION['user_id'];

			$sql= "INSERT INTO todo SET user_id='".$user_id."', todo_name='".$data['todo_title']."', todo_desc='".$data['todo_desc']."'";
			//Adding To-Do
			if ( isset($data['due_date']) && $data['due_date']!="" ) {
				$sql = $sql.", due_date='".$data['due_date']."'";
			}

			if ( isset($data['todo_status']) && $data['todo_status']!="" ) {
				$sql = $sql.", status='2'";
			}
			$output = $this->con->query($sql);

			$todo_id = $this->con->insert_id;

			if($todo_id){
				$filter_data = array(
					'todo_id' => $todo_id
				);
				$todo_details = $this->get_all_todo($filter_data);
				$result=array();
				$result['is_added'] = true;
				$result['error'] = false;
				$result['todo_id'] = $todo_id;
				$result['todo_details']=$todo_details;
				return $result;
			}else{
				return null;
			}
		}
	}
