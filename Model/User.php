<?php
namespace Model;
use src\Model;
class User extends Model {
	public function virtual()
	{
		var_dump($this->query("SELECT * FROM clientes LIMIT :limit", array('limit' => 1))->sizeRow());
	}
}