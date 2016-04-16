<?php
class BusinessGateway {
	private $db;
	
	public function __construct() {
		$this->db = new Database();
	}
	
	/* Get the records specified by pagification data and make sure not to exceed maximum allowed records */
	public function fetchBusinessesList($pagification) {
		$business_array = array();
		
		$query = "SELECT * FROM business LIMIT :start, :amount";
		$statement = $this->db->prepare($query);
		$statement->bindValue(":start", $pagification['page_start']);
		$statement->bindValue(":amount", min($pagification['amount'], $pagification['max']));
		$rs = $statement->execute();
		
		while($business = $rs->fetchArray(SQLITE3_ASSOC)) {
			array_push($business_array, $business);
		}
		
		$statement->close();
		
		return $business_array;
	}
	
	public function fetchBusiness($id) {
		$query = "SELECT * FROM business WHERE id = :id";
		$statement = $this->db->prepare($query);
		$statement->bindParam(":id", $id);
		$rs = $statement->execute();
		$business = $rs->fetchArray(SQLITE3_ASSOC);
		$statement->close();
		
		if($business == FALSE) {					/* A business that returns false means it wasn't in the database */
			$errors = new Error(404, "The business was not found");
			return $errors->getError();
		}
		return $business;
	}
	
}
?>