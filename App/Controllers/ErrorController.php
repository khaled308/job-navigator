<?php

namespace App\Controllers;

class ErrorController {
    public static function notFound() {
        http_response_code(404);
        loadView('error');
        exit();
    }
}