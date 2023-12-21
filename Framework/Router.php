<?php

namespace Framework;

class Router
{
    private $routes = [];
    private $errorPage = '404';
    private $queries = [];
    private $params = [];

    public function add(string $method, string $path, array $controller) : void {
        $path = $this->normalizeUri($path);
        $method = strtolower($method);
        $this->routes[$method][$path] = $controller;
    }

    public function dispatch(string $method, string $uri) {
        $uri = $this->normalizeUri($uri);
        $method = strtolower($method);
        $this->extractQueries($uri);
        $uri = strtok($uri, '?');
        $route = $this->extractParams($method, $uri);
        

        [$class, $fn] = $this->routes[$method][$uri] ?? null;

        if (!$class && !$fn && $route) {
            [$class, $fn] = $this->routes[$method][$route] ?? null;
        }


        if ($class && $fn) {
            $controller = new $class;
            $controller->{$fn}($this->params, $this->queries);
        } 
        else {
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

        if ($pos !== false) {
            $keys = explode('&', substr($uri, $pos + 1));
    
            foreach ($keys as $key) {
                [$k, $v] = explode('=', $key);
                $this->queries[$k] = $v;
            }
        }
    }

    private function extractParams($method, $uri) {
        $routes = $this->routes[$method] ?? [];
        $uri = explode('/', trim($uri, "/"));
   
        foreach ($routes as $route => $controller) {
            $routeElements = explode('/', trim($route, "/"));
            
            if (count($routeElements ) !== count($uri)) {
                continue;
            }
            
            $this->params = [];

            for ($i = 0; $i < count($routeElements); $i++) {
                if (strpos($routeElements [$i], ':') !== false) {
                    $key = str_replace(':', '', $routeElements [$i]);
                    $this->params[$key] = $uri[$i];
                }


                else if ($routeElements [$i] !== $uri[$i]) {
                    $this->params = [];
                    break;
                }
            }

            if (count($this->params) > 0) {
                return $route;
            }
        }

        return null;
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