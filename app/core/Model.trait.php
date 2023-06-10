<?php 

Trait Model {

	use Database;

	public $limit = 5;
	public $offset = 0;

	public function select($columnNames) {

		$commaSeparatedColumns = implode(', ', $columnNames);

		$queryString = "SELECT $commaSeparatedColumns FROM $this->table LIMIT $this->limit OFFSET $this->offset";

		return $this->query($queryString);
	}

	public function selectAll() {

		$queryString = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset";

		return $this->query($queryString);
	}

	public function insert($columnNames, $columnValues) {

		$commaSeparatedColumns = implode(', ', $columnNames);

		$columnValuesCount = count($columnValues);
		$questionMarksArray = array();
		for($i = 0; $i < $columnValuesCount; $i++) {
			$questionMarksArray[] = '?';
		}
		$questionMarks = implode(', ', $questionMarksArray);

		$queryString = "INSERT INTO $this->table ($commaSeparatedColumns) VALUES ($questionMarks)";

		return $this->query($queryString, $columnValues);
	}
}