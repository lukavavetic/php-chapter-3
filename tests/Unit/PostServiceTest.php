<?php

namespace Tests\Unit;

use App\Domain\Commands\CreatePostCommand;
use App\Domain\Exceptions\PostNotFound;
use App\Domain\PostService;
use App\Domain\ReadModels\PostReadModel;
use App\Domain\Repositories\PostRepositoryInterface;
use Mockery\MockInterface;
use Tests\TestCase;

/** @group Unit */
class PostServiceTest extends TestCase
{
    public function testPostCreated(): void
    {
        $title = 'Title';
        $description = 'Description';
        $userId = 1;

        $expectedReadModel = new PostReadModel(1, $title, $description);

        /** @var MockInterface $postService */
        $postRepository = \Mockery::mock(PostRepositoryInterface::class);

        $postRepository->shouldReceive('save')
            ->once()
            ->andReturn(true);

        $postRepository->shouldReceive('findPostById')
            ->once()
            ->andReturn($expectedReadModel);

        /** @var PostRepositoryInterface $postRepository */
        $postService = new PostService($postRepository);

        $actualReadModel = $postService->create(new CreatePostCommand($title, $description, $userId));

        $this->assertSame($expectedReadModel->title(), $actualReadModel->title());
        $this->assertSame($expectedReadModel->description(), $actualReadModel->description());
    }

    public function testCreatePostExpectException(): void
    {
        $title = 'Title';
        $description = 'Description';
        $userId = 1;

        /** @var MockInterface $postService */
        $postRepository = \Mockery::mock(PostRepositoryInterface::class);

        /**
         * @link https://phpunit.readthedocs.io/en/9.5/test-doubles.html#mock-objects
         */
        $postRepository->shouldReceive('save')
            ->once()
            ->andReturn(true);

        $postRepository->shouldReceive('findPostById')->once();

        $this->expectException(PostNotFound::class);

        /** @var PostRepositoryInterface $postRepository */
        $postService = new PostService($postRepository);

        $postService->create(new CreatePostCommand($title, $description, $userId));
    }
}