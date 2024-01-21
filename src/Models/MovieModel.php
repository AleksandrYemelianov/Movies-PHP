<?php

namespace App\Models;

class MovieModel
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private string $preview,
        private string $createdAt,
        private string $updatedAt,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPreview(): string
    {
        return $this->preview;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
