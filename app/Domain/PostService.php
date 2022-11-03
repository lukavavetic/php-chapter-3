<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Commands\CreatePostCommand;
use App\Domain\Exceptions\PostNotFound;
use App\Domain\ReadModels\PostReadModel;
use App\Domain\Repositories\PostRepositoryInterface;

class PostService
{
    public function __construct(
        public PostRepositoryInterface $postRepository
    ) {}

    /** @throws PostNotFound */
    public function create(CreatePostCommand $command): PostReadModel
    {
        $title = $command->title();
        $description = $command->description();
        $userId = $command->userId();

        $postId = 1;

        $this->postRepository->save(
            postId: $postId,
            title: $title,
            description: $description,
            createdByUserId: $userId
        );

        $post = $this->postRepository->findPostById(id: $postId);

        if (null === $post) {
            throw new PostNotFound(message: 'Post not found!');
        }

        return $post;
    }
}