<?php

namespace App\Controllers;
use Framework\Database;

class JobController {
    public function listing() {
        $db = Database::getInstance();

        $jobs = $db->query(
            'SELECT id, title, description, address, salary, work_type, tags FROM jobs ORDER BY id DESC'
            )->fetchAll();

        loadView('listings', ['jobs' => $jobs]);
    }

    public function create() {
        loadView('post-job');
    }
}