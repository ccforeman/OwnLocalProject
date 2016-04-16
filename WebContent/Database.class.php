<?php 
class Database extends SQLite3 {
	private $db;
	
	public function __construct() {
		
		if(!isset($this->$db) || $this->$db == null) {		/* Will only open database connection if not already open */
			$this->open('../ownlocal');
		}
	}
}
?>