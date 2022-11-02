<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        require __DIR__ . '/../integral/bootstrap.php';

        var_dump(getenv('APP_ENV'));
        die();
    }
}