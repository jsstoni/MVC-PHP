<?php
namespace src;
class DB {
	private $db;
	private $stmt;
	private $data;

	public function __construct()
	{
		$this->db = dbConnect::getInstance();
	}

	public function query(string $sql, array $params = [])
	{
		try {
			$this->stmt = $this->db->prepare($sql);
			$this->stmt->execute($params);
		} catch (Exception $e) {
			die($e->getMessage());
		}
		return $this;
	}

	public function fetchAll() {
		return $this->stmt->fetchAll();
	}

	public function sizeRow()
	{
		return $this->stmt->rowCount();
	}

	public function where(string $w)
	{
		return "WHERE {$w}";
	}

	private function _colums(array $c) {
		return '(' . implode(", ", array_keys($c[0] ?? $c)) . ')';
	}

	private function _values(array $v)
	{
		$_values = array();
		foreach ($v as $row) {
			if (is_array($row)) {
				$_values[] = '(' . implode(',', array_fill(0, count($row), '?')) . ')';
			}
		}
		if (sizeof($_values) >= 1) {
			return ' VALUES ' . implode(',', $_values);
		}
		return ' VALUES ('. substr(str_repeat(',?', count($v)), 1) . ')';
	}

	public function insert($tableName, array $values = [], $wildcard = '')
	{
		$sql = '';
		switch ($wildcard) {
			case 'IGNORE':
				$sql = "INSERT IGNORE INTO {$tableName} ";
				break;
			case 'REPLACE':
				$sql = "REPLACE INTO {$tableName} ";
				break;
			default:
				$sql = "INSERT INTO {$tableName} ";
				break;
		}
		$sql .= $this->_colums($values);
		$sql .= $this->_values($values);

		$dataToInsert = array();
		foreach ($values as $row => $data) {
			if (is_array($data)) {
				foreach($data as $val) {
					$dataToInsert[] = $val;
				}
			}else {
				$dataToInsert[] = $data;
			}
		}
		try {
			$this->stmt = $this->db->prepare($sql);
			$this->stmt->execute($dataToInsert);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function update($tableName)
	{
		return $this;
	}

	public function delete($tableName)
	{
		return $this;
	}
}