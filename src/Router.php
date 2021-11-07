<?php
/**
 * Router
 */
namespace src;
class Router
{
	private	$REQUEST_URL,
			$HOST_URL,
			$MAIN_FOLDER;

	public function __construct()
	{
		$this->REQUEST_URL = $_SERVER['REQUEST_URI'];
		$this->HOST_URL = $_SERVER['HTTP_HOST'];
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
}
?>