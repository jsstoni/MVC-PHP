<?php

namespace App\Router;

use App\Router\RouteUtils;
use App\Router\useRouter;

abstract class Router extends useRouter
{
    use RouteUtils;

    public static function create($base)
    {
        self::$useRouter = new useRouter($base);
        self::read('./routes');
    }

    public static function get(String $path, $handler, ...$middleware)
    {
        self::$useRouter->addRoute('GET', $path, $handler, $middleware);
    }

    public static function post(String $path, $handler, ...$middleware)
    {
        self::$useRouter->addRoute('POST', $path, $handler, $middleware);
    }

    public static function patch(String $path, $handler, ...$middleware)
    {
        self::$useRouter->addRoute('PATCH', $path, $handler, $middleware);
    }

    public static function put(String $path, $handler, ...$middleware)
    {
        self::$useRouter->addRoute('PUT', $path, $handler, $middleware);
    }

    public static function delete(String $path, $handler, ...$middleware)
    {
        self::$useRouter->addRoute('DELETE', $path, $handler, $middleware);
    }

    public static function __callStatic($name, $arguments)
    {
        self::$useRouter->{$name}(...$arguments);
    }

    public static function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        self::$useRouter->dispatch($method, $url);
    }
}
