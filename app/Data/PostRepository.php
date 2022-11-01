<?php

declare(strict_types=1);

namespace App\Data;

use App\Domain\ReadModels\PostReadModel;
use App\Domain\Repositories\PostRepositoryInterface;

final class PostRepository implements PostRepositoryInterface
{
    public function save(int $postId, string $title, string $description, int $createdByUserId): void
    {

    }

    public function findPostById(int $id): ?PostReadModel
    {
        return new PostReadModel(title: 'Title', description: 'Description');
    }
}