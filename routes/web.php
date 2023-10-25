<?php

use App\Router\Router;

Router::get('/', function ($req, $res) {
	$res->status(200)->send("hola mundo");
});

Router::get('/other', 'Controllers\Web@home');
