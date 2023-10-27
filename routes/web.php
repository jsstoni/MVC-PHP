<?php

use App\Http\Request;
use App\Http\Response;
use App\Http\Router;

Router::get('/', function (Request $req, Response $res) {
    $res->status(200)->render("index");
});

Router::get('/other', 'Controllers\Web@home');
