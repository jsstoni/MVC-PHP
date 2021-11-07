<?php
/**
 * Router
 */
namespace src;
class Router
{
	const	DEFAULT_REGEX = '/:([^\/]+)/',
			REPLACE_REGEX = '([^/]+)';

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
		$path = $path == '/' ? '/' : rtrim($path, '/');
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

	private function _regexRouter($str)
	{
		$str = preg_replace(self::DEFAULT_REGEX, self::REPLACE_REGEX, $str);
		$str = '/^' . str_replace('/', '\/', $str) . '\/*$/s';
		return $str;
	}

	private function _callback($url = '/')
	{
		return array_filter($this->ROUTERS, function($k) use ($url) {
			$e = $this->getMain().$k;
			return preg_match($this->_regexRouter($e), $url);
		}, ARRAY_FILTER_USE_KEY);
	}

	public function run()
	{
		if ($r = $this->_callback($this->REQUEST_URL)) {
			echo "Success";
		}else {
			echo "Error";
		}
	}
}
?>