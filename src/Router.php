<?php
/**
 * Router
 */
namespace src;
class Router
{
	private	$REQUEST_URL,
			$HOST_URL,
			$MAIN_FOLDER,
			$ROUTERS = [];

	public function __construct()
	{
		$this->REQUEST_URL = $_SERVER['REQUEST_URI'];
		$this->HOST_URL = $_SERVER['HTTP_HOST'];
		$routes = require_once ROOT . 'config' . DS .'routes.php';
		foreach ($routes as $pattern => $fn) {
			$this->add($pattern, $fn);
		}
	}

	public function setMain($path)
	{
		$path = $path == '/' ? '.' : ltrim($path, '/');
		define('BASE_PATH', $path);
		$this->MAIN_FOLDER = $path;
	}

	public function getMain()
	{
		return $this->MAIN_FOLDER;
	}

	public function add($pattern, $fn)
	{
		$this->ROUTERS[$pattern] = $fn;
	}

	public function run()
	{
		print_r($this->ROUTERS);
	}
}
?>