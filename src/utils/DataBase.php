<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(require_once('../config/db.php'));

$capsule->setAsGlobal();
$capsule->bootEloquent();
