<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller
{
    public function index(): void
    {
        $categories = new CategoryService($this->getDatabase());
        $movies = new MovieService($this->getDatabase());
        $this->view('admin/index',
            ['categories' => $categories->all(), 'movies' => $movies->all()]);
    }
}
