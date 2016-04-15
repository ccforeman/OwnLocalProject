<?php 
class Error {
	private $error;
	
	
	public function __construct($code) {
		$this->error = array('status' => $code, 'source' => "", 'title' => "" , 'detail' => "");
		
		switch($code) {
			case 404 :
				$this->error['title'] = "Not Found";
				$this->error['detail'] = "Only accepting GET requests";
				break;
			case 405 :
				$this->error['source'] = "Request";
				$this->error['title'] = "Method not allowed";
				$this->error['detail'] = "Only accepting GET requests";
				break;
			case 500 :
				break;
			default :
				
		}
	}
	
	public function getError() {
		return json_encode(array('errors' => $this->error), JSON_PRETTY_PRINT);
	}
}

?>