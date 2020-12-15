<?php
session_start();

//For converting normal text response to JSON Resopnse
function to_json_response($response, $result, $allGetVars){
	return $response
			->write(json_encode($result))
			->withHeader('Content-type', 'application/json')
			->withStatus(200);
}

//For authenticate user and converting normal text response to JSON Resopnse
function login_check(){
	if(isset($_SESSION["user_id"])){
		return true;
	}else{
		return false;
	}
}