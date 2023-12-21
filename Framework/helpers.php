<?php

function loadView($view, $data = []) {
    if (isset($_SESSION['success_message'])) {
        $data['SESSION_SUCCESS'] = $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }

    if (isset($_SESSION['data']) && isset($_SESSION['errors'])) {
        $data = $_SESSION['data'];
        $data['errors'] = $_SESSION['errors'];

        unset($_SESSION['errors']);
        unset($_SESSION['data']);
    }

    extract($data);
    $path = __DIR__ . "/../App/views/$view.php";
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

function sanitize($data) {
    return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
}