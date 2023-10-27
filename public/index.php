<?php
require 'vendor/autoload.php';

use App\Http\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$main_route = isset($_ENV['MAIN']) ? $_ENV['MAIN'] : '/';
Router::create($main_route);
Router::run();
