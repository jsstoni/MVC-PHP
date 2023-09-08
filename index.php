<?php
require 'vendor/autoload.php';
use App\Router\Router;

Router::create('/');
Router::run();