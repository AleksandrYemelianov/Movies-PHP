<?php

namespace App\Kernel\Upload;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        private readonly string $name,
        private readonly string $fullPath,
        private readonly string $type,
        private readonly string $pmpName,
        private readonly string $error,
        private readonly string $size,
    ) {
    }

    public function move(string $path, ?string $fileName = null): string|false
    {
        $storagePath = APP_PATH."/storage/$path";
        $storage = mkdir($storagePath, 0777, true);
if (is_dir())
    }
}
