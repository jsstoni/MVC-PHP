<?php
namespace Controllers;
use Models\Project as Project;

class Web
{
	public function home($req) {
		print_r(Project::all());
	}
}