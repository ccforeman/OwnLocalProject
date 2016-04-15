<?php 
class GetController {
	private $req_method;
	private $uri;
	private $uri_object;
	private $arg;
	private $page_start;
	private $amount;
	private $count;
	private $metadata;
	private $gateway;
	private $errors;
	
	public function __construct($req_method, $uri, $uri_object, $arg, $page_start, $amount) {
		$this->req_method = $req_method;
		$this->uri = $uri;
		$this->uri_object = $uri_object;
		$this->arg = $arg;
		$this->page_start = isset($page_start) ? $page_start : 0;
		$this->amount = isset($amount) ? $amount : 50;
		$this->gateway = new BusinessGateway();
	}
	
	public function run($obj, $arg) {
		
		switch($obj) {
			case "businesses" :
					$businesses = $this->gateway->fetchBusinessesStart($this->page_start, $this->amount);
					$this->metadata = array('page_start' => $this->page_start, 'amount' => $this->amount);
					$data = array('meta' => $this->metadata, 'businesses' => $businesses);
					$this->respondJson($data);
					$this->page_start += $this->amount;
				break;
				
			case "business" :
				if( !$this->isValidArgument($arg) ) {
					http_response_code(404);
					die();
				}
				$data = $this->gateway->fetchBusiness($arg);
				$this->respondJson($data);
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
	
	public function respondJson($response) {
		echo json_encode($response, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT) . "\n";
	}
	
}

?>