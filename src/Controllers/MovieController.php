<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class MovieController extends Controller
{
    private MovieService $service;

    public function index(): void
    {
        $this->view(name: 'movies');
    }

    public function create(): void
    {
        $categories = new CategoryService($this->getDatabase());
        $this->view('admin/movies/add', ['categories' => $categories->all()]);
    }

    public function store(): void
    {

        $validation = $this->request()->validate([
            'name' => ['require', 'min:2', 'max:30'],
            'description' => ['require'],
            'categories' => ['require'],
        ]);
        if (! $validation) {

            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }

            $this->redirect('/admin/movies/add');
        }
        $name = $this->request()->input('name');
        $description = $this->request()->input('description');
        $categories = $this->request()->input('categories');
        $preview = $this->request()->file('image');

        $this->service()->store($name, $description, $categories, $preview);
        $this->redirect('/admin');
    }

    private function service(): MovieService
    {
        if (! isset($this->service)) {
            $this->service = new MovieService($this->getDatabase());
        }

        return $this->service;
    }
}
