<?php 
class Error {
	private $error;
	
	
	public function __construct($code, $detail) {
		$this->error = array('status' => $code, 'title' => "" , 'detail' => $detail);
		
		switch($code) {
			case 400 :
				$this->error['title'] = "Bad Request";
				break;
			case 404 :
				$this->error['title'] = "Not Found";
				break;
			case 405 :
				$this->error['title'] = "Method Not Allowed";
				break;
			case 500 :
				break;
				
		}
		
		http_response_code($code);			/* Set the error code in the http response header */
	}
	
	public function getError() {
		return array('error' => $this->error);
	}
}

?>