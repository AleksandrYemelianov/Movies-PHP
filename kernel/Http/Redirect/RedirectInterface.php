<?php

namespace App\Kernel\Http\Redirect;

interface RedirectInterface
{
    public function to(string $uri);
}
