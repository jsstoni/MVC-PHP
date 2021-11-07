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
}