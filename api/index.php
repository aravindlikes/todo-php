<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;
	//use Slim\Factory\AppFactory;

	require_once dirname(dirname(__FILE__)) . '/api/vendor/autoload.php';

	//Including Common Functions
	require_once dirname(dirname(__FILE__)) . '/api/common.php';

	$app = new \Slim\App([
		'settings' => [
			'displayErrorDetails' => true,
		],
	]);

	$c = $app->getContainer();

	//405 Error Handler
	$c['notAllowedHandler'] = function ($c) {
		return function ($request, $response, $methods) use ($c) {
			$msg = array('error' => true, 'error_code' => '405', 'error_msg' => 'Method must be one of: ' . implode(', ', $methods) );
			return $response->withStatus(405)
				->withHeader('Allow', implode(', ', $methods))
				->withHeader('Content-type', 'application/json')
				->write(json_encode($msg));
		};
	};

	//404 Error Handler
	$c['notFoundHandler'] = function ($c) {
		return function ($request, $response) use ($c) {
			$msg = array('error' => true, 'error_code' => '404', 'error_msg' => 'Page not found. Check URL');
			return $response->withStatus(404)
				->withHeader('Content-Type', 'application/json')
				->write(json_encode($msg));
		};
	};

	// 500 Error Handler
	// $c['errorHandler'] = function ($c) {
	//     return function ($request, $response, $exception) use ($c) {
	//     	$msg = array('error' => true, 'error_code' => '500', 'error_msg' => 'Something went wrong!');
	//         return $response->withStatus(500)
	//             ->withHeader('Content-Type', 'application/json')
	//             ->write(json_encode($msg));
	//     };
	// };

	//

	$app->post('/add_user', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/usercontroller.php';
		$user = new user_controller;
		$allGetVars = $request->getQueryParams();
		$result = $user->add_user($allGetVars);
		return to_json_response($response, $result, $allGetVars);
	});

	$app->post('/getuser', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/usercontroller.php';
		$user = new user_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $user->get_user($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/login', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/usercontroller.php';
		$user = new user_controller;
		$allGetVars = $request->getQueryParams();
		$result = $user->login($allGetVars);
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/login_check', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/usercontroller.php';
		$user = new user_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $user->login_check($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'No User logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/logout_user', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/usercontroller.php';
		$user = new user_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $user->logout_user($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/add_todo', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/todocontroller.php';
		$todo = new todo_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $todo->add_todo($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/get_all_todo', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/todocontroller.php';
		$todo = new todo_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $todo->get_all_todo($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/get_overdue_todo', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/todocontroller.php';
		$todo = new todo_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $todo->get_overdue_todo($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/get_pending_todo', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/todocontroller.php';
		$todo = new todo_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $todo->get_pending_todo($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->get('/get_completed_todo', function (Request $request, Response $response, array $args) {
		require_once dirname(dirname(__FILE__)) . '/api/database/Controller/todocontroller.php';
		$todo = new todo_controller;
		$allGetVars = $request->getQueryParams();
		$user_logged = $_SESSION["user_id"];
		if($user_logged && isset($user_logged)){
			$result = $todo->get_completed_todo($allGetVars);
		}else{
			$result = array('error' => true, 'error_code' => '500', 'error_msg' => 'User not logged in');
		}
		return to_json_response($response, $result, $allGetVars);
	});

	$app->run();
