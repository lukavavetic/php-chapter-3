<?php

namespace App\Data;

class DB implements DBInterface
{
    public function save(string $table, array $entity): void
    {
        file_put_contents(
            sprintf(__DIR__.'/../../integral/database/%s', $table),
            json_encode($entity, JSON_PRETTY_PRINT)
        );
    }
}