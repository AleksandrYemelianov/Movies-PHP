<?php

namespace App\Kernel\Middleware;

interface MiddlewareInterface
{
    public function check(array $middleware = []): void;
}
