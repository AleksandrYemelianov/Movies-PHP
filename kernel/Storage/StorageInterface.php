<?php

namespace App\Kernel\Storage;

interface StorageInterface
{
    public function uri(string $path): string;

    public function get(string $path): string;
}
