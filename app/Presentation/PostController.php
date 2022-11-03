<?php

declare(strict_types=1);

namespace App\Presentation;

use App\Domain\Commands\CreatePostCommand;
use App\Domain\PostService;

final class PostController
{
    public function __construct(private PostService $postService)
    {}

    public function create(array $requestBody): string
    {
        $command = new CreatePostCommand(
            title: $requestBody['title'],
            description: $requestBody['description'],
            userId: $requestBody['userId'],
        );

        $readModel = $this->postService->create($command);

        $response = json_encode(['title' => $readModel->title(), 'description' => $readModel->description()], JSON_PRETTY_PRINT);

        echo $response;

        return $response;
    }
}