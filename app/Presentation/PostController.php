<?php

declare(strict_types=1);

namespace App\Presentation;

final class PostController
{
    public function create(array $request): void
    {
        echo $request['title'];
    }
}