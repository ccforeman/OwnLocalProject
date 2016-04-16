<?php 
class GetController {
	private $uri_object;
	private $arg;
	private $extraneous;
	private $page_start;
	private $amount;
	private $count;
	private $metadata;
	private $gateway;
	private $error;
	
	public function __construct($uri_object, $arg, $extraneous, $page_start, $amount) {
		$this->uri_object = $uri_object;
		$this->arg = $arg;
		$this->extraneous = $extraneous;
		$this->page_start = isset($page_start) ? (int) $page_start : 0;
		$this->amount = isset($amount) ? (int) $amount : 50;
		$this->gateway = new BusinessGateway();
	}
	
	public function run() {
		
		switch($this->uri_object) {
			case "businesses" :
				if( !empty($this->arg) || !$this->isPaginationValid() ) {
					$this->error = new Error(400, "Invalid: bad data in URI");
					return $this->error->getError();
				}
				$this->metadata = array('page_start' => $this->page_start, 'amount' => $this->amount, 'max' => 10000);
				$businesses = $this->gateway->fetchBusinessesList($this->metadata);
				$data = array('businesses' => $businesses, 'meta' => $this->metadata);
				break;
				
			case "business" :
				if( !$this->isArgumentValid() ) {
					$this->error = new Error(400, "Invalid: bad syntax in URI");
					return $this->error->getError();
				}
				$data = $this->gateway->fetchBusiness($this->arg);
				break;
				
			default :
				$error = new Error(400, "Invalid: bad syntax in URI");
				return $error->getError();
		}
	
		return $data;
	}
	
	/* id should be numeric, greater than or equal to 0 and should have no value after it including slash(/) */
	private function isArgumentValid() {
		
		if( empty($this->extraneous) && is_numeric($this->arg) && $this->arg >= 0)
			return true;
		
		else
			return false;
	}
	
	/* Pagination parameters should be numeric, and greater than 0 except page_start can be 0 */
	private function isPaginationValid() {
		if( is_numeric($this->page_start) && is_numeric($this->amount)
				&& $this->page_start >= 0 && $this->amount > 0)
			return true;
		else
			return false;
	}
	
}

?>