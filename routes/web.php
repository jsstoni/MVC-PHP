<?php

use Route\Router;
use Route\Request;
use Route\Response;

Router::get('/', function (Request $req, Response $res) {
    $res->status(200)->render("index");
});

Router::get('/other', 'App\Controllers\Web@home');
