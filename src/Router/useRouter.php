<?php

namespace App\Router;

use App\Request;

class useRouter
{
    protected $routes = [];
    public $currentGroup = '';
    public $main = '/';

    public function __construct($base)
    {
        $this->main = ltrim($base, '/');
    }

    public function group($cb)
    {
        if (is_callable($cb)) {
            $cb();
        }
        $this->currentGroup = '';
    }

    public function addRoute($method, $path, $handler, $middleware)
    {
        $path = $this->currentGroup != '' ? ($path != '/' ? $this->currentGroup . $path : $this->currentGroup) : $path;
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                throw new \Exception('Route already exists: ' . $method . ' ' . $path);
            }
        }
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    private function typeHandler($handler)
    {
        if (is_string($handler)) {
            $handlerParts = explode("@", $handler);
            if (count($handlerParts) !== 2) {
                throw new \Exception("Invalid handler format.");
            }
            [$className, $methodName] = $handlerParts;
            $controller = [new $className, $methodName];
        } else if (is_array($handler) && count($handler) === 2) {
            $controller = $handler;
        } else if (is_callable($handler)) {
            $controller = $handler;
        } else {
            throw new \Exception("Invalid handler format.");
        }

        return $controller;
    }

    public function dispatch($method, $url)
    {
        $urlParts = parse_url($url);
        $pathWithQuery = $urlParts['path'] . (isset($urlParts['query']) ? '?' . $urlParts['query'] : '');
        if ($method === 'OPTIONS') { //preflight fix
            http_response_code(200);
            exit();
        }
        foreach ($this->routes as $route) {
            if ($route['method'] == $method) {
                $path = $this->main . $route['path'];
                $pattern = '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '(/?)?(\?.*)?$#';
                if (preg_match($pattern, $pathWithQuery, $matches)) {
                    $request = new Request();
                    $params = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));
                    $request->setParams($params);
                    $params = $request->getParams();
                    foreach ($route['middleware'] as $middleware) {
                        $midlePart = explode(":", $middleware);
                        $className = $midlePart[0];
                        $methodName = $midlePart[1];
                        $fullClassName = "Middleware\\{$className}";
                        if (class_exists($fullClassName)) {
                            $middleInstance = new $fullClassName();
                            $response = call_user_func(array($middleInstance, $methodName), $params);
                            if (isset($response['error'])) {
                                exit(json_encode($response));
                            }
                        }
                    }
                    return call_user_func($this->typeHandler($route['handler']), $params);
                }
            }
        }
        http_response_code(404);
        echo "404 Not Found";
        return;
    }
}
