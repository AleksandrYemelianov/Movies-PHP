<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\CategoryModel;

class CategoryService
{
    public function __construct(private DatabaseInterface $database)
    {
    }

    public function all(): array
    {
        $categories = $this->database->get('categories');
        $categories = array_map(function ($category) {
            return new CategoryModel(
                id: $category['id'],
                name: $category['name'],
                createdAt: $category['created_at'],
                updatedAt: $category['updated_at']
            );
        }, $categories);

        return $categories;
    }

    public function store(string $name): int
    {
        return $this->database->insert(
            'categories',
            ['name' => $name]
        );
    }

    public function find(int $id): ?CategoryModel
    {
        $category = $this->database->first('categories', ['id' => $id]);
        if (! $category) {
            return null;
        }

        return new CategoryModel(
            id: $category['id'],
            name: $category['name'],
            createdAt: $category['created_at'],
            updatedAt: $category['updated_at']
        );
    }

    public function update(int $id, string $name): void
    {
        $this->database->update('categories', ['name' => $name], ['id' => $id]);
    }

    public function delete(int $id): void
    {
        $this->database->delete('categories', ['id' => $id]);
    }
}
