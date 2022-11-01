<?php

declare(strict_types=1);

namespace App\Domain\ReadModels;

final class PostReadModel
{
    public function __construct(
        public string $title,
        public string $description,
    ) {}
}