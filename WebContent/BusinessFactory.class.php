<?php
class BusinessFactory {
	
	public function fetchAllBusinesses() {
		$business_array = array();
		
		try {
			$db = Database::getDB();
			$query = "SELECT * FROM business";
			$statement = $db->prepare($query);
			$statement->execute();
			while($business = $statement->fetch(PDO::FETCH_ASSOC)) {
				array_push($business_array, $business);
			}
			
			$statement->closeCursor();
		} catch (PDOException $e) {
			die();
		}
		
		return array("business" => $business_array);
	}
	
	public function fetchBusiness($id) {
		try {
			$db = Database::getDB();
			$query = "SELECT * FROM business WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(":id", $statement);
			$statement->execute();
			$business = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor();
		} catch (PDOException $e) {
			die();
		}
		
		return $business[0];
	}
}
?>