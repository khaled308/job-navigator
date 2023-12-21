<?php

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;

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

    public function show($params = [], $queries = []) {
        $jobId = $params['job'];
        $job = $this->db->query(
            'SELECT * FROM jobs WHERE id = ?',
            [$jobId]
        )->fetch();
        
        if (!$job) {
            ErrorController::notFound();
        }

        loadView('details', ['job' => $job]);
    }

    public function store() {
        $allowedFields = [
            'title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'
        ];

        $data = array_intersect_key($_POST, array_flip($allowedFields));
        $data['user_id'] = 1;

        $data = array_map('sanitize', $data);
        $errors = Validation::validate($data, 
            ['title' => 'min_length=3', 'description' => 'min_length=15', "salary" => "required"
        ]);

        if (!empty($errors)){
            loadView('post-job', ['errors' => $errors, 'data' => $data]);
        }

        else {
            $this->db->insert("jobs", $data);
            redirect("/listings");
        }
    }

    public function destroy($params = [], $queries = []) {
        $jobId = $params['job'];
        $job = $this->db->query(
            'SELECT * FROM jobs WHERE id = ?',
            [$jobId]
        )->fetch();
        
        if (!$job) {
            ErrorController::notFound();
            return;
        }

        $this->db->query("DELETE FROM jobs WHERE id = ?", [$jobId]);
        redirect("/listings");
    }
}