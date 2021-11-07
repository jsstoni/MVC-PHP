<?php
/**
 * 
 */
namespace Controller;
use src\Controller;
class Home extends Controller
{
	public function Default($req)
	{
		$user = $this->makeModel('User');
		$user->virtual();
		parent::View('index.html');
	}
}