<?php

function loadView($view, $data = []) {
    extract($data);
    $path = __DIR__ . "/../views/$view.php";
    require_once $path;
}

function redirect($path) {
    header("Location: $path");
    exit;
}

function dd(...$data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die;
}

function old($name) {
    return $_REQUEST[$name] ?? '';
}

