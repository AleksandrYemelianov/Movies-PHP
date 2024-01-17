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
        $email = trim($this->request()->input('email'));
        $password = trim($this->request()->input('password'));
        $this->getAuth()->attempt($email, $password);

        if ($this->getAuth()->attempt($email, $password)) {
            $this->redirect('/');
        }
        $this->session()->set('error', 'Incorrect email or password');

        $this->redirect('/login');

    }

    public function logout()
    {
        $this->getAuth()->logout();

        return $this->redirect('/login');
    }
}
