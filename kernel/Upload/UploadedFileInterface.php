<?php

namespace App\Kernel\Upload;

interface UploadedFileInterface
{
    public function move(string $path, ?string $fileName = null): string|false;

    public function randomFileName(): string;

    public function getExtension(): string;
}
