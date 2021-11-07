<?php
/**
 * 
 */
namespace Controller;
class Home
{
	public function Default($req)
	{
		echo $req->__GET('id');
	}
}