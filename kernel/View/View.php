<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exception\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
    ) {
    }

    public function page(string $name, array $data = []): void
    {

        $viewPath = APP_PATH."/views/pages/$name.php";
        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }
        extract(array_merge($this->extractParams(), $data));
        include_once $viewPath;
    }

    public function component(string $name, array $data = []): void
    {

        $componentPath = APP_PATH."/views/component/$name.php";

        if (! file_exists($componentPath)) {
            echo "View $name not found";

            return;
        }
        extract(array_merge($this->extractParams(), $data));
        include $componentPath;
    }

    private function extractParams(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
        ];
    }
}
