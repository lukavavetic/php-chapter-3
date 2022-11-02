<?php

declare(strict_types=1);

namespace App\Data;

use App\Domain\ReadModels\PostReadModel;
use App\Domain\Repositories\PostRepositoryInterface;

final class PostRepository implements PostRepositoryInterface
{
    private string $tableName = '';
    private DBInterface $database;

    public function __construct(DBInterface $database)
    {
        $this->tableName = getenv('DB_TABLE');
        $this->database = $database;
    }

    public function save(int $postId, string $title, string $description, int $createdByUserId): void
    {
        $entity = [
            $postId => [
                'title' => $title,
                'description' => $description,
                'createdByUserId' => $createdByUserId,
            ],
        ];

        $this->database->save($this->tableName, $entity);
    }

    public function findPostById(int $id): ?PostReadModel
    {
        $entities = json_decode(file_get_contents(__DIR__.'/../../integral/database/post_table.json'), true);

        $post = $entities[$id];

        return new PostReadModel(title: $post['title'], description: $post['description']);
    }
}