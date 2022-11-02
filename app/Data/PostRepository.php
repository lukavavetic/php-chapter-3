<?php

declare(strict_types=1);

namespace App\Data;

use App\Domain\ReadModels\PostReadModel;
use App\Domain\Repositories\PostRepositoryInterface;
use Symfony\Component\Dotenv\Dotenv;

final class PostRepository implements PostRepositoryInterface
{
    private string $tableName = '';

    public function __construct()
    {
        $this->tableName = getenv('DB_TABLE');
    }

    public function save(int $postId, string $title, string $description, int $createdByUserId): void
    {
        var_dump($this->tableName);
        die();
        $entity = [
            $postId => [
                'title' => $title,
                'description' => $description,
                'createdByUserId' => $createdByUserId,
            ],
        ];

        file_put_contents(__DIR__.'/../../integral/database/post_table.json', json_encode($entity, JSON_PRETTY_PRINT));
    }

    public function findPostById(int $id): ?PostReadModel
    {
        $entities = json_decode(file_get_contents(__DIR__.'/../../integral/database/post_table.json'), true);

        $post = $entities[$id];

        return new PostReadModel(title: $post['title'], description: $post['description']);
    }
}