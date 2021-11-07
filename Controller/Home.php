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
		if ($user->virtual()) {
			echo "Ingresado";
		}else {
			echo "Error al ingresar";
		}
	}
}