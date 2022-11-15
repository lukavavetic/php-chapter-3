<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\ReadModels\PostReadModel;

interface PostRepositoryInterface
{
    public function save(int $postId, string $title, string $description, int $createdByUserId): bool;

    public function findPostById(int $id): ?PostReadModel;
}