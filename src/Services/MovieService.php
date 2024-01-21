<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\MovieModel;

class MovieService
{
    public function __construct(private DatabaseInterface $database)
    {
    }

    public function all(): array
    {
        $movies = $this->database->get('movies');
        $movies = array_map(function ($movie) {
            return new MovieModel(
                id: $movie['id'],
                name: $movie['name'],
                description: $movie['description'],
                preview: $movie['preview'],
                createdAt: $movie['created_at'],
                updatedAt: $movie['updated_at']
            );
        }, $movies);

        return $movies;
    }

    public function store(string $name, string $description, int $categories, UploadedFileInterface $preview): false|int
    {
        $filePath = $preview->move('movies');

        return $this->database->insert(
            'movies',
            ['name' => $name,
                'description' => $description,
                'preview' => $filePath,
                'category_id' => $categories,
            ],
        );
    }

    public function find(int $id): ?MovieModel
    {
        $movie = $this->database->first('movies', ['id' => $id]);
        if (! $movie) {
            return null;
        }

        return new MovieModel(
            id: $movie['id'],
            name: $movie['name'],
            description: $movie['description'],
            preview: $movie['preview'],
            createdAt: $movie['created_at'],
            updatedAt: $movie['updated_at']
        );
    }

    //    public function update(int $id, string $name): void
    //    {
    //        $this->database->update('categories', ['name' => $name], ['id' => $id]);
    //    }
    //
    //    public function delete(int $id): void
    //    {
    //        $this->database->delete('categories', ['id' => $id]);
    //    }
}
