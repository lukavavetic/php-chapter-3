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

    public function save(int $postId, string $title, string $description, int $createdByUserId): bool
    {
        $entity = [
            $postId => [
                'title' => $title,
                'description' => $description,
                'createdByUserId' => $createdByUserId,
            ],
        ];

        try {
            $this->database->save($this->tableName, $entity);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function findPostById(int $id): ?PostReadModel
    {
        $post = $this->database->findById($this->tableName, $id);

        return new PostReadModel(id: $id, title: $post['title'], description: $post['description']);
    }
}