<?php 
class Database extends SQLite3{
	private static $db;
	
	public static function getDB() {
		try {
			if(!isset(self::$db) || self::$db == null) {
				/* temporary local database... Need to write script to generate from CSV */
				self::$db = new PDO('sqlite:../ownlocal') or die("cannot open database");
				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch (PDOException $e){
			die("Database couldn't be opened\n");
		}
		
		return self::$db;
	}
}
?>