<?php

namespace Framework;

class Router
{
    private $routes = [];

    public function add(string $method, string $path, array $controller) : void {
        $path = $this->normalizeUri($path);
        $method = strtolower($method);
        $this->routes[$method][$path] = $controller;
    }

    public function dispatch(string $method, string $uri) {
        $uri = $this->normalizeUri($uri);
        $method = strtolower($method);
        [$class, $method] = $this->routes[$method][$uri] ?? null;

        if ($class && $method) {
            $controller = new $class;
            $controller->{$method}();
        } else {
            echo '404';
        }
    }

    private function normalizeUri(string $uri) {
        $uri = trim($uri, '/');
        $uri =  "/{$uri}/";
        $uri = preg_replace('/\/+/', '/', $uri);
        return $uri;
    }

}