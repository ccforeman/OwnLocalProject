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
			die("fetchAllBusinesses failed\n");
		}
		
		return array("business" => $business_array);
	}
	
	public function fetchBusiness($id) {
		try {
			$db = Database::getDB();
			$query = "SELECT * FROM business WHERE id = :id";
			$statement = $db->prepare($query);
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