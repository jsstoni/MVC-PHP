<?php

use App\Router\Router;

Router::get('/', function ($req, $res) {
	$res->status(200)->render("index");
});

Router::get('/other', 'Controllers\Web@home');
