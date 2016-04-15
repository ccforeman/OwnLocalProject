<?php
include('ClassLoader.php');
	header('Content-type: application/json');
	$req_method = $_SERVER['REQUEST_METHOD'];
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	list($blank, $uri_object, $arg, $extraneous) = explode("/", $uri);
	$page_amount = (array_key_exists('amount', $_GET)) ? $_GET['amount'] : null;
	$page_number = (array_key_exists('page', $_GET)) ? $_GET['page'] : null;
	
	if(!empty($extraneous)) {
		http_response_code(404);
		die();										/* Messages included with all dies for debugging */
	}
	
	$api = new MainController($req_method, $uri, $uri_object, $arg, $page_amount, $page_number);
	$response = $api->run($uri_object, $arg);
	echo $response . "\n";
	
?>