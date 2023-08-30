<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Sort;

interface SortableInterface
{
    public function sort(mixed $data, Sort $sort): mixed;
}
