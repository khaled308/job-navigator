<?php

$router->errorPage('error');

$router->add('GET','/', ['\App\Controllers\HomeController', 'index']);
$router->add('GET','/listings', ['\App\Controllers\JobController', 'listing']);
$router->add('GET','/post-job', ['\App\Controllers\JobController', 'create']);