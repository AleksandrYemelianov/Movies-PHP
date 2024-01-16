<?php

namespace App\Kernel\Storage;

use App\Kernel\Config\ConfigInterface;

class Storage implements StorageInterface
{
    public function __construct(private ConfigInterface $config)
    {
    }

    public function uri(string $path): string
    {
        $uri = $this->config->get('app.uri');

        return "$uri/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents($this->storagePath($path));
    }

    public function storagePath(string $path): string
    {
        return APP_PATH."/storage/$path";
    }
}
