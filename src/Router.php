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

	private function _mactchUrl($url = '/')
	{
		return array_filter($this->ROUTERS, function($k) use ($url) {
			$e = $this->getMain().$k;
			return preg_match($this->_regexRouter($e), $url);
		}, ARRAY_FILTER_USE_KEY);
	}

	private function _callback($fn)
	{
		switch (true) {
			case (is_string($fn)):
				list($controller, $method) = explode("@", $fn);
				$controller = "Controller\\{$controller}";
				$controller = array((new $controller), $method);
				break;
			case (is_array($fn)):
				$controller = $fn;
				break;
			case (is_callable($fn)):
				$controller = $fn;
				break;
			default:
				$controller = NULL;
				break;
		}
		return $controller;
	}

	private function _arguments($path)
	{
		$args = array();
		$route_ex = explode('/', $path[0]);
		$url_ex = explode('/', $this->REQUEST_URL);
		
		if (($key_main = array_search(trim($this->getMain(), '/'), $url_ex)) !== false) {
			unset($url_ex[$key_main]);
		}

		$query = array_combine($route_ex, $url_ex);
		foreach ($query as $key => $value) {
			if (preg_match(self::DEFAULT_REGEX, $key)) {
				$key = str_replace(':', '', $key);
				if (! array_key_exists($key, $args)) {
					$args[$key] = $value;
				}else {
					throw new Exception("Error Processing Request", 1);
				}
			}
		}
		return $args;
	}

	public function run()
	{
		$r = $this->_mactchUrl($this->REQUEST_URL);
		if ($r) {
			$path = array_keys($r);
			$fn = array_values($r);
			call_user_func_array($this->_callback($fn[0]), $this->_arguments($path));
		}else {
			echo "Error";
		}
	}
}
?>