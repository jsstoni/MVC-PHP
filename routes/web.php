<?php

use App\Router\Router;

Router::get('/', function ($req) {
	echo "hola mundo";
});

Router::get('/other', 'Controller\Web@home');
