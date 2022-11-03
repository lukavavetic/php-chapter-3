<?php

namespace Tests\Unit;

use App\Domain\PostService;
use App\Domain\ReadModels\PostReadModel;
use App\Presentation\PostController;
use Mockery\MockInterface;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testSave(): void
    {
        $title = 'Title';
        $description = 'Description';
        $userId = 1;

        $requestBody = [
            'title' => $title,
            'description' => $description,
            'userId' => $userId
        ];

        $expectedResponse = [
            'title' => $title,
            'description' => $description,
        ];

        /** @var MockInterface $postService */
        $postService = \Mockery::mock(PostService::class);

        $postService->shouldReceive('create')
            ->once()
            ->andReturn(new PostReadModel(
                title: $title, description: $description
            ));

        /** @var PostService $postService */
        $postController = new PostController($postService);

        $result = $postController->create($requestBody);

        $this->assertSame($expectedResponse, json_decode($result, true));
    }
}