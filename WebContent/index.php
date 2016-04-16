<?php
include('ClassLoader.php');
	header('Content-type: application/json');
	header('Allow: GET');
	
	$req_method = $_SERVER['REQUEST_METHOD'];
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	list($blank, $uri_object, $arg, $extraneous) = explode("/", $uri);
	$page_start = (array_key_exists('page_start', $_GET)) ? $_GET['page_start'] : null;
	$amount = (array_key_exists('amount', $_GET)) ? $_GET['amount'] : null;

	switch($req_method) {
		case 'GET' :
			$api = new GetController($uri_object, $arg, $extraneous, $page_start, $amount);
			echo json_encode($api->run($uri_object, $arg), JSON_PRETTY_PRINT ). "\n";
			break;
		default :
			$error = new Error(405, "Only accepting GET requests");
			echo json_encode( $error->getError(), JSON_PRETTY_PRINT ) . "\n";
			break;
	}
	
?>