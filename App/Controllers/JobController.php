<?php

namespace App\Controllers;
use Framework\Database;

class JobController {
    private $db;
    function __construct(){
        $this->db = Database::getInstance();
    }
    public function index() {

        $jobs = $this->db->query(
            'SELECT id, title, description, address, salary, work_type, tags FROM jobs ORDER BY id DESC'
            )->fetchAll();

        loadView('listings', ['jobs' => $jobs]);
    }

    public function create() {
        loadView('post-job');
    }

    public function show($jobId) {
        $job = $this->db->query(
            'SELECT * FROM jobs WHERE id = ?',
            [$jobId]
        )->fetch();

        loadView('details', ['job' => $job]);
    }
}