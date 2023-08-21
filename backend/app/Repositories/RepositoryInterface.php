<?php

declare(strict_types=1);

namespace App\Repositories;

interface RepositoryInterface
{
    public function fetch(): mixed;

    public function save(mixed $data): void;
}
