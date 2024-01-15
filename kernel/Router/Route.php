<?php

namespace App\Kernel\Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middleware = []
    ) {
    }

    public static function get(string $uri, $action, array $middleware = []): static
    {
        return new static(uri: $uri, method: 'GET', action: $action, middleware: $middleware);
    }

    public static function post(string $uri, $action, array $middleware = []): static
    {
        return new static(uri: $uri, method: 'POST', action: $action, middleware: $middleware);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function hasMiddleware(): bool
    {
        return ! empty($this->middleware);
    }
}
