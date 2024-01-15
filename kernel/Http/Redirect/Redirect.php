<?php

namespace App\Kernel\Http\Redirect;

class Redirect implements RedirectInterface
{
    public function to(string $uri)
    {
        header("Location: $uri");
        exit();
    }
}
