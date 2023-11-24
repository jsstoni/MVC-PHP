<?php

namespace App\Controllers;

use App\Models\Project as Project;

class Web
{
    public function home($req)
    {
        print_r(Project::all());
    }
}
