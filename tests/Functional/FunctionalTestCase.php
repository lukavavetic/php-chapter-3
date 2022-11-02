<?php

namespace Tests\Functional;

use Tests\TestCase;

class FunctionalTestCase extends TestCase
{
    public function post(array $requestBody): array
    {
        return json_decode(shell_exec(sprintf("php index.php /post.create '%s'", json_encode($requestBody))), true);
    }
}