<?php
/**
 * Router
 */
namespace src;
class Router
{
	private	$REQUEST_URL,
			$HOST_URL;

	public function __construct()
	{
		$this->REQUEST_URL = $_SERVER['REQUEST_URI'];
		$this->HOST_URL = $_SERVER['HTTP_HOST'];
	}
}
?>