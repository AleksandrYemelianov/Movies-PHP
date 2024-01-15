<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function login()
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');
        $this->getAuth()->attempt($email, $password);

        $this->redirect('/home');

    }

    public function logout()
    {
        $this->getAuth()->logout();

        return $this->redirect('/login');
    }
}
