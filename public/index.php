<?php
require __DIR__ . '/../vendor/autoload.php';

use Route\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$main_route = isset($_ENV['MAIN']) ? $_ENV['MAIN'] : '/';
Router::create(dirname(__DIR__), $main_route);
Router::run();
