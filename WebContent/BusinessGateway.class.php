<?php
class BusinessGateway {
	private $db;
	
	public function __construct() {
		$this->db = Database::getDB();
	}
	
	public function fetchAllBusinesses($amount, $start) {
		$business_array = array();
		$amount = (empty($amount)) ? 50 : $amount;
		$start = (empty($start)) ? 0 : $start;
		
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
			die($e->getMessage() . "\n");
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