<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $service;

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
        $this->service()->store($name);
        $this->redirect('/admin');
    }

    public function delete()
    {
        $idCategory = $this->request()->input('id');
        $this->service()->delete($idCategory);
        $this->redirect('/admin');
    }

    private function service(): CategoryService
    {
        if (! isset($this->service)) {
            $this->service = new CategoryService($this->getDatabase());
        }

        return $this->service;
    }
}
