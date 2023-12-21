<?php

namespace App\Controllers;
use Framework\Database;

class HomeController {
    private $db;
    function __construct(){
        $this->db = Database::getInstance();
    }

    public function index() {
        $jobs = $this->db->query(
            'SELECT id, title, description, address, salary, work_type, tags FROM jobs ORDER BY id DESC LIMIT 6'
            )->fetchAll();
       

        loadView('home', ['jobs' => $jobs]);
    }
}