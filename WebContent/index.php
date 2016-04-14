<?php
include('ClassLoader.php');

	$req_method = $_SERVER['REQUEST_METHOD'];
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	list($blank, $uri_object, $arg, $extraneous) = explode("/", $uri);
	$page_amount = (array_key_exists('amount', $_GET)) ? $_GET['amount'] : null;
	$page_number = (array_key_exists('page', $_GET)) ? $_GET['page'] : null;
	// Eventually need paramaters for GET /business if they exist
	
	if(!empty($extraneous)) {
		http_response_code(404);
		die("invalid\n");							/* Messages included with all dies for debugging */
	}
	
	switch($req_method) {
		case 'GET' :								/* valid - continue on to determine validity of fields */
			$returned_object = action($uri_object, $arg);
			break;
		default :
			http_response_code(405);				/* 405: Request Method Invalid */
			die("invalid request method\n");
			break;
	}
	respondAsJson($returned_object);
	
	
	function action($obj, $arg) {
		$factory = new BusinessFactory();
		
		if( !( isValidObject($obj) || isValidArgument($arg)) ) {
			http_response_code(404);
			die("invalid object or argument\n");
		}
		if( is_null($arg) ) { 
			$result = $factory->fetchAllBusinesses($_GET['amount'], $_GET['page']);
		} else {
			$result = $factory->fetchBusiness($arg);
		}
		
		return $result;
	}
	
	function isValidObject($obj) {
		switch($obj) {
			case 'business' :
				return true;
			default :
				return false;
		}
	}
	
	function isValidArgument($arg) {
		if( is_numeric($arg) && $arg >= 0 ) {
			return true;
		}
		
		return false;
	}
	
	function respondAsJson($data) {
		echo json_encode($data, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT) . "\n";
	}
	
?>