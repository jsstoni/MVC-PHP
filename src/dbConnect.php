<?php
namespace src;
use PDO;
class dbConnect {
	private static $instance;
	private function __construct()
	{
	}
	private function __clone()
	{
	}

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			try {
				self::$instance = new PDO('mysql:host=localhost;dbname=selge', 'root', '', array(
					PDO::ATTR_EMULATE_PREPARES => false,
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
				));
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$instance;
	}

}