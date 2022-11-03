<?php

declare(strict_types=1);

namespace Tests\Functional;

use Tests\TestCase;

class FunctionalTestCase extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearDatabase();
    }

    public function post(array $requestBody): array
    {
        return json_decode(shell_exec(sprintf("php index.php /post.create '%s'", json_encode($requestBody))), true);
    }
}