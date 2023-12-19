<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Framework/helpers.php';

$app = new Framework\App();

// routes
$router = $app->getRouter();

$router->add('GET','/', ['\App\Controllers\HomeController', 'index']);

// run app
$app->run();
