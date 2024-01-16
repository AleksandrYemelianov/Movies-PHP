<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view(name: 'movies');
    }

    public function add(): void
    {
        $this->view(name: 'admin/movies/add');
    }

    public function store(): void
    {
        $file = $this->request()->file('images');
        $filePath = $file->move('movies');

        $validation = $this->request()->validate([
            'name' => ['require', 'min:5', 'max:10'],
        ]);
        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/admin/movies/add');
        }
        $name = $this->request()->input('name');
        $id = $this->getDatabase()->insert('movies', ['name' => $name]);
        dd("Movie add $id");
    }
}
