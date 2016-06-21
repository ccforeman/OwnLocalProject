<?php 
class Database extends SQLite3 {
	
	public function __construct() {
		$db = $this->open('../business.db');
	}
}
?>