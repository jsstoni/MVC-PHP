<?php
namespace Model;
use src\Model;
class User extends Model {
	public function virtual()
	{
		return $this->insert('order_id', array('usuario' => 2, 'order_id' => 1));
	}
}