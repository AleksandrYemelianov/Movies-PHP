<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('register');
    }

    public function register(): void
    {

        $validation = $this->request()->validate([
            'name' => ['require', 'min:3', 'max:30'],
            'email' => ['require', 'email'],
            'password' => ['require', 'min:8', 'confirmed'],
            'password_confirmation' => ['require', 'min:8'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/register');
        }
        $name = trim($this->request()->input('name'));
        $email = trim($this->request()->input('email'));
        $password = trim(password_hash($this->request()->input('password'), PASSWORD_DEFAULT));

        $idUser = $this->getDatabase()->insert(
            'users',
            ['name' => $name, 'email' => $email, 'password' => $password]
        );
        $this->redirect('/');
    }
}
