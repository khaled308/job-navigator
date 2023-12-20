<?php

namespace Framework;

class Router
{
    private $routes = [];
    private $errorPage = '404';

    public function add(string $method, string $path, array $controller) : void {
        $path = $this->normalizeUri($path);
        $method = strtolower($method);
        $this->routes[$method][$path] = $controller;
    }

    public function dispatch(string $method, string $uri) {
        $uri = $this->normalizeUri($uri);
        $method = strtolower($method);
        $query = $this->extractQueries($uri);
        $uri = strtok($uri, '?');
  
        [$class, $method] = $this->routes[$method][$uri] ?? null;

        if ($class && $method) {
            $controller = new $class;
            $controller->{$method}();
        } else {
            $this->displayErrorPage();
        }
    }

    private function normalizeUri(string $uri) {
        $uri = trim($uri, '/');
        $uri =  "/{$uri}/";
        $uri = preg_replace('/\/+/', '/', $uri);
        return $uri;
    }

    private function extractQueries(string $uri) {
        $uri =trim($uri, '/');
        $pos = strpos($uri, '?');

        if ($pos === false) {
            return [];
        }

        $keys = explode('&', substr($uri, $pos + 1));
        $queries = [];

        foreach ($keys as $key) {
            [$k, $v] = explode('=', $key);
            $queries[$k] = $v;
        }

        return $queries;
    }

    public function errorPage($page) {
        $this->errorPage = $page;
    }

    private function displayErrorPage() {
        $file = __DIR__ . '/../App/views/' . $this->errorPage . '.php';
        http_response_code(404);

        if (file_exists($file)){
            require_once $file;
            exit;
        }

        else {
            echo '404';
        }
    }

}