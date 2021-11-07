<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)).DS);
#require_once 'assets/vendor/autoload.php'; #composer
function autoloading() {
	spl_autoload_register(function ($class) {
		$file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
		if (file_exists($file)) {
			require_once $file;
			return;
		}
	});
}
autoloading();
$router = new src\Router;
$router->setMain('/MVC-PHP');
$router->run();