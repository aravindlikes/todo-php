<?php
	class todo_controller{

		private $todo_model;

		function __construct() {
			require_once dirname(dirname(__FILE__)) . '/Model/todomodel.php';
			$this->todo_model = new todo_model;
		}

		public function get_all_todo( $data = array()){
			$error=false;
			$error_msg = '';
			$filter_data = array();
			if( isset($_SESSION['user_id']) && $_SESSION['user_id'] !=""){
				$filter_data['user_id'] = $_SESSION['user_id'];
			}
			$results= $this->todo_model->get_all_todo($filter_data);
			if($results){
				return $results;
			}else{
				return array('error' => true, 'error_code' => '404', 'error_msg' => 'No to-do Found.');
			}
		}
		public function get_overdue_todo( $data = array()){
			$error=false;
			$error_msg = '';
			$filter_data = array();
			if( isset($_SESSION['user_id']) && $_SESSION['user_id'] !=""){
				$filter_data['user_id'] = $_SESSION['user_id'];
			}
			$results= $this->todo_model->get_overdue_todo($filter_data);
			if($results){
				return $results;
			}else{
				return array('error' => true, 'error_code' => '404', 'error_msg' => 'No to-do Found.');
			}
		}
		public function get_completed_todo( $data = array()){
			$error=false;
			$error_msg = '';
			$filter_data = array();
			if( isset($_SESSION['user_id']) && $_SESSION['user_id'] !=""){
				$filter_data['user_id'] = $_SESSION['user_id'];
			}
			$results= $this->todo_model->get_completed_todo($filter_data);
			if($results){
				return $results;
			}else{
				return array('error' => true, 'error_code' => '404', 'error_msg' => 'No to-do Found.');
			}
		}
		public function get_pending_todo( $data = array()){
			$error=false;
			$error_msg = '';
			$filter_data = array();
			if( isset($_SESSION['user_id']) && $_SESSION['user_id'] !=""){
				$filter_data['user_id'] = $_SESSION['user_id'];
			}
			$results= $this->todo_model->get_pending_todo($filter_data);
			if($results){
				return $results;
			}else{
				return array('error' => true, 'error_code' => '404', 'error_msg' => 'No to-do Found.');
			}
		}
		public function add_todo($data=array()){
			$error = false;
			$result = array();

			if ( isset($data['todo_title']) && $data['todo_title']!="" ) {
				$todo_title = $data['todo_title'];
			} else {
				$error = true;
				$result['error']=true;
				$result['error_msg']['todo_title'] = "Todo Title must be greater than 1 character";
			}

			if ( isset($data['todo_desc']) && $data['todo_desc']!="" ) {
				$todo_desc = $data['todo_desc'];
			}else{
				$todo_desc = "";
			}

			if ( isset($data['due_date']) && $data['due_date']!="" ) {
				$due_date = $data['due_date'];
			}else{
				$due_date = "";
			}

			if ( isset($data['todo_status']) && $data['todo_status']!="" ) {
				$todo_status = $data['todo_status'];
			}else{
				$todo_status = "";
			}


			if($error){
				return $result;
			}else{
				$todo_data=array(
					'todo_title'	=> $todo_title,
					'todo_desc'		=> $todo_desc,
					'due_date'		=> $due_date,
					'todo_status'	=> $todo_status
				);
				$output = $this->todo_model->add_todo($todo_data);

				return $output;

				if($output['is_added']){
					return $output;
				}else{
					return array('error' => true, 'error_code' => '405', 'error_msg' => 'unable to save. Please try after some time');
				}
			}
		}
	}
?>