<?php
class BusinessFactory {
	private $db;
	
	public function __construct() {
		$this->db = Database::getDB();
	}
	
	public function fetchAllBusinesses($amount = 50, $start = 1) {
		$business_array = array();
		
		try {
			$this->db = Database::getDB();
			$query = "SELECT * FROM business LIMIT :amount";
			$statement = $this->db->prepare($query);
			$statement->bindValue(":amount", $amount);
			$statement->execute();
			while($business = $statement->fetch(PDO::FETCH_ASSOC)) {
				array_push($business_array, $business);
			}
			
			$statement->closeCursor();
		} catch (PDOException $e) {
			die("fetchAllBusinesses failed\n");
		}
		
		return array("business" => $business_array);
	}
	
	public function fetchBusiness($id) {
		try {
			$this->db = Database::getDB();
			$query = "SELECT * FROM business WHERE id = :id";
			$statement = $this->db->prepare($query);
			$statement->bindValue(":id", $id);
			$statement->execute();
			$business = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor();
		} catch (PDOException $e) {
			die("fetchBusiness failed\n");
		}
		
		return $business[0];
	}
	
}
?>