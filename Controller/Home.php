<?php
/**
 * 
 */
namespace Controller;
class Home
{
	public function default() {
		print_r(func_get_args());
	}
}