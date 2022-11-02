<?php

namespace Tests\Unit;

use App\Data\DBInterface;
use App\Data\PostRepository;
use Mockery\MockInterface;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    public function testExample(): void
    {
        /** @var MockInterface $database */
        $database = \Mockery::mock(DBInterface::class);

        $database->shouldReceive('save')->once()->andReturn();

        /** @var DBInterface $database */
        $postRepository = new PostRepository($database);

        $result = $postRepository->save(1, 'title', 'description', 2);

        $this->assertNull($result);
    }
}