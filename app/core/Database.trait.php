<?php 

Trait Database {

	private function connect() {

		$string = 'mysql:hostname='.DBHOST.';dbname='.DBNAME;
		$con = new PDO($string, DBUSER, DBPASS);

		return $con;
	}

	public function query($queryString, $paramValues = array()) {

		$con = $this->connect();
		$stm = $con->prepare($queryString);
		$check = $stm->execute($paramValues);

		if($check) {

			$result = $stm->fetchAll(PDO::FETCH_OBJ);

			if(is_array($result) && count($result)) {

				return $result;
			}
		}

		return false;
	}

	public function getFirstRow($queryString, $paramValues = array()) {

		$con = $this->connect();
		$stm = $con->prepare($queryString);
		$check = $stm->execute($paramValues);

		if($check) {

			$result = $stm->fetchAll(PDO::FETCH_OBJ);

			if(is_array($result) && count($result)) {

				return $result[0];
			}
		}

		return false;
	}
	
}

