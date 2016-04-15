<?php 
class MainController {
	private $req_method;
	private $uri;
	private $uri_object;
	private $arg;
	private $page_amount;
	private $page_number;
	private $metadata;
	private $gateway;
	
	public function __construct($req_method, $uri, $uri_object, $arg, $page_amount, $page_number) {
		$this->req_method = $req_method;
		$this->uri = $uri;
		$this->uri_object = $uri_object;
		$this->arg = $arg;
		$this->page_amount = $page_amount;
		$this->page_number = $page_number;
		$this->metadata = array();
		$this->gateway = new BusinessGateway();
	}
	
	public function run($obj, $arg) {
		
		switch($obj) {
			case "businesses" :
				$data = $this->gateway->fetchAllBusinesses($this->page_amount, $this->page_number);
				break;
				
			case "business" :
				if( !$this->isValidArgument($arg) ) {
					http_response_code(404);
					die();
				}
				$data = $this->gateway->fetchBusiness($arg);
				break;
				
			default :
				http_response_code(404);
				die();
		}
	
		return json_encode($data, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
	}
	
	public function isValidArgument($arg) {
		if( is_numeric($arg) && $arg >= 0 ) {
			return true;
		}
	
		return false;
	}
	
}

?>