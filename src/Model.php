<?php
namespace src;
class Model extends DB {
	private $data;

	public function db()
	{
		return DB::getInstance();
	}

	public function getData($key) {
		return $this->data[$key] ?? null;
	}

	public function setData(array $values = [])
	{
		foreach ($values as $key => $value) {
			$this->$key = $value;
		}
	}

	public function __get($key)
	{
		return $this->data[$key];
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}
}