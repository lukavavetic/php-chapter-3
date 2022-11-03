<?php

declare(strict_types=1);

namespace App\Domain\ReadModels;

final class PostReadModel
{
    public function __construct(
        private string $title,
        private string $description,
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}