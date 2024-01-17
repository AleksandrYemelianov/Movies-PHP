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
}
