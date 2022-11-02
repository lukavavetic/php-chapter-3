<?php

namespace App\Data;

interface DBInterface
{
    public function save(string $table, array $entity): void;
    public function findById(string $table, int $id): array;
}