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
		parent::View('index.html', ['virtual' => 'Casa']);
	}
}