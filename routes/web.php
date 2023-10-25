<?php

use App\Request;
use App\Response;
use App\Router\Router;

Router::get('/', function (Request $req, Response $res) {
    $res->status(200)->render("index");
});

Router::get('/other', 'Controllers\Web@home');
