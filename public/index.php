<?php
require 'vendor/autoload.php';

use App\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

Router::create('/');
Router::run();
