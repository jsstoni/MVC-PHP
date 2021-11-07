<?php
namespace src;
use PDO;
class DB {
	public $db;
	private static $instance;
	public function __construct()
	{
		try {
			$this->db = new PDO('mysql:host=localhost;dbname=selge', 'root', '', array(
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
			));
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$object = __CLASS__;
			self::$instance = new $object;
		}
		return self::$instance;
	}
}