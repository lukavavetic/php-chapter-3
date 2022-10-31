<?php

namespace App\Controllers;

final class PostController
{
    public function create(array $request): void
    {
        echo $request['title'];
    }
}