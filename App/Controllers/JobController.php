<?php

namespace App\Controllers;

class JobController {
    public function listing() {
        loadView('listings');
    }

    public function create() {
        loadView('post-job');
    }
}