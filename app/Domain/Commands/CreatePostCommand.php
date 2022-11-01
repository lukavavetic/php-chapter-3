<?php

declare(strict_types=1);

namespace App\Domain\Commands;

final class CreatePostCommand
{
    public function __construct(
        public string $title,
        public string $description,
        public int $userId,
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}