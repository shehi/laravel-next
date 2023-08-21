<?php

declare(strict_types=1);

namespace App\Services;

interface ServiceInterface
{
    public function fetch(): mixed;

    public function save(mixed $data): void;
}
