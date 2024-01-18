<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class CategoryController extends Controller
{
    public function create(): void
    {
        $this->view('admin/categories/add');
    }

    public function store(): void
    {
        $validation = $this->request()->validate(['name' => ['required', 'min:3', 'max:50']]);
        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/admin/categories/add');
        }
        $name = trim($this->request()->input('name'));
        $this->getDatabase()->insert(
            'categories',
            ['name' => $name]
        );
        $this->redirect('/admin');
    }

    public function delete()
    {
        $idCategory = $this->request()->input('id');
        $this->getDatabase()->delete('categories', ['id' => $idCategory]);
        $this->redirect('/admin');
    }
}
