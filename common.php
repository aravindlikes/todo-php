<?php
session_start();
//URL List

//API Calls
$api_base_url     		= "http://127.0.0.1/to-do/api/";
$login_check_api		= $api_base_url."login_check";
$login_link_api			= $api_base_url."login";
$logout_link_api		= $api_base_url."logout_user";
$add_todo_api     		= $api_base_url."add_todo";
$get_overdue_todo_api	= $api_base_url."get_overdue_todo";
$get_all_todo_api		= $api_base_url."get_all_todo";

//Page Calls
$page_base_url 		= "http://127.0.0.1/to-do/";
$to_do_page			= $page_base_url."todo-list.php";
$login_page			= $page_base_url."index.php";
?>
