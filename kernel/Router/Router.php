<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Controller\Controller;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;
use App\Middleware\AuthMiddleware;

class Router implements RouterInterface
{
    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DatabaseInterface $database,
        private AuthInterface $auth,

    ) {
        $this->initRoutes();
    }

    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private function getRoutes(): array
    {
        return require APP_PATH.'/config/routes.php';
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);
        if (! $route) {
            echo '404 | Not Found';
            exit();
        }
        if ($route->hasMiddleware()) {
            foreach ($route->getMiddleware() as $middleware) {
                /** @var AuthMiddleware $middleware */
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();
            /** @var Controller $controller */
            $controller = new $controller;

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }
}
