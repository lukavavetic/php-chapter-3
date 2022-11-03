<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Domain\Commands\CreatePostCommand;
use App\Domain\PostService;

/** @group Integration */
class PostServiceTest extends IntegrationTestCase
{
    public function testPostIsCreatedAndStoredInDatabase(): void
    {
        $title = 'Title';
        $description = 'Description';
        $userId = 1;

        $command = new CreatePostCommand(
            title: $title,
            description: $description,
            userId: $userId
        );

        /** @var PostService $postService */
        $postService = $this->getInstanceFromServiceContainer('PostService');

        $readModel = $postService->create($command);

        $this->assertSame($readModel->title(), $title);
        $this->assertSame($readModel->description(), $description);

        $entity = $this->getRecordFromDatabaseById($readModel->id());

        $this->assertNotNull($entity);
        $this->assertSame($entity['title'], $title);
        $this->assertSame($entity['description'], $description);
        $this->assertSame($entity['createdByUserId'], $userId);
    }
}