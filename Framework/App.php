<?php

namespace Framework;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }
 
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method']))
            $method = $_POST['_method'];

        $this->router->dispatch($method, $_SERVER['REQUEST_URI']);
    }

    public function getRouter() : Router
    {
        return $this->router;
    }
}