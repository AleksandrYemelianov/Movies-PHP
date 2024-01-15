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
            'email' => ['require', 'email'],
            'password' => ['require', 'min:8'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/register');
        }
        $email = $this->request()->input('email');
        $password = password_hash($this->request()->input('password'), PASSWORD_DEFAULT);

        $idUser = $this->getDatabase()->insert('users',
            ['email' => $email, 'password' => $password]);
        dd("User add $idUser");
    }
}
