<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\TestCase;

class IntegrationTestCase extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearDatabase();
    }

    protected function getRecordFromDatabaseById(int $id): array
    {
        $entities = json_decode(
            file_get_contents(
                sprintf(__DIR__.'/../../integral/database/%s', getenv('DB_TABLE'))),
            true
        );

        return $entities[$id];
    }

    protected function getInstanceFromServiceContainer(string $alias): ?object
    {
        $containerBuilder = $GLOBALS['containerBuilder'];

        return $containerBuilder->get($alias);
    }
}