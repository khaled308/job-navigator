<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Framework/helpers.php';

$app = new Framework\App();
$router = $app->getRouter();

// routes
require_once __DIR__ .  '/../App/routes.php';

// run app
$app->run();
