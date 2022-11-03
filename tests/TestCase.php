<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        require __DIR__ . '/../integral/bootstrap.php';
    }

    protected function clearDatabase(): void
    {
        file_put_contents(
            sprintf(__DIR__.'/../integral/database/%s', getenv('DB_TABLE')),
            ''
        );
    }
}