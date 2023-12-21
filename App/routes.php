<?php

$router->errorPage('error');

$router->add('GET','/', ['\App\Controllers\HomeController', 'index']);
$router->add('GET','/listings', ['\App\Controllers\JobController', 'index']);
$router->add('GET','/post-job', ['\App\Controllers\JobController', 'create']);
$router->add('POST', '/post-job', ['\App\Controllers\JobController', 'store']);
$router->add('GET','/listings/:job', ['\App\Controllers\JobController', 'show']);
$router->add('DELETE','/listings/:job', ['\App\Controllers\JobController', 'destroy']);