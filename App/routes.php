<?php

$router->errorPage('error');

$router->add('GET','/', ['\App\Controllers\HomeController', 'index']);
$router->add('GET','/listings', ['\App\Controllers\JobController', 'index']);
$router->add('GET','/post-job', ['\App\Controllers\JobController', 'create']);
$router->add('GET','/listings/:job', ['\App\Controllers\JobController', 'show']);