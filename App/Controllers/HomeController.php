<?php

namespace App\Controllers;
use Framework\Database;

class HomeController {
    public function index() {
        $db = Database::getInstance();
        $jobs = $db->query(
            'SELECT id, title, description, address, salary, work_type, tags FROM jobs ORDER BY id DESC LIMIT 6'
            )->fetchAll();
       

        loadView('home', ['jobs' => $jobs]);
    }
}