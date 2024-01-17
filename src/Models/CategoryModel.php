<?php

namespace App\Models;

class CategoryModel
{
    public function __construct(
        private int $id,
        private string $name,
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
