<?php

declare(strict_types=1);

namespace App\Presentation;

use App\Domain\Commands\CreatePostCommand;
use App\Domain\PostService;

final class PostController
{
    public function __construct(private PostService $postService)
    {}

    public function create(array $requestBody): void
    {
        $command = new CreatePostCommand(
            title: $requestBody['title'],
            description: $requestBody['description'],
            userId: $requestBody['userId'],
        );

        $readModel = $this->postService->create($command);

        echo json_encode(['title' => $readModel->title(), 'description' => $readModel->description()], JSON_PRETTY_PRINT);
    }
}