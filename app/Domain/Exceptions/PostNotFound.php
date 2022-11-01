<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

final class PostNotFound extends \Exception
{
    public function __construct(string $message, Throwable $previous = null, ?int $code = 0)
    {
        parent::__construct($message, $code, $previous);
    }
}
