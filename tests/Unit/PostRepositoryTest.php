<?php

namespace Tests\Unit;

use App\Data\DBInterface;
use App\Data\PostRepository;
use Mockery\MockInterface;
use Tests\TestCase;

/** @group Unit */
class PostRepositoryTest extends TestCase
{
    /**
     * @dataProvider blogPostDataProvider
     */
    public function testSaveSucceeded(int $id, string $title, string $description, int $createdByUserId): void
    {
        /** @var MockInterface $database */
        $database = \Mockery::mock(DBInterface::class);

        /**
         * @link
         */
        $database->shouldReceive('save')->once();

        /** @var DBInterface $database */
        $postRepository = new PostRepository($database);

        $result = $postRepository->save($id, $title, $description, $createdByUserId);

        $this->assertTrue($result);
    }

    public function testSaveFailed(): void
    {
        /** @var MockInterface $database */
        $database = \Mockery::mock(DBInterface::class);

        $database->shouldReceive('save')->once()->andThrow(new \Exception());

        /** @var DBInterface $database */
        $postRepository = new PostRepository($database);

        $result = $postRepository->save(1, 'title', 'desc', 2);

        $this->assertFalse($result);
    }

    /**
     * @link  https://phpunit.readthedocs.io/en/9.5/writing-tests-for-phpunit.html#data-providers
     */
    public function blogPostDataProvider(): array
    {
        return [
            [1, 'title-1', 'description-1', 1],
            [2, 'title-2', 'description-2', 2],
            [3, 'title-3', 'description-3', 3],
            [4, 'title-4', 'description-4', 4],
        ];
    }
}