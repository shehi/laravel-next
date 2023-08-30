<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Sort;
use App\Repositories\RepositoryInterface;

class CardService implements ServiceInterface, SortableInterface
{
    public function __construct(private readonly RepositoryInterface $repository)
    {
    }

    public function fetch(): mixed
    {
        return $this->repository->fetch();
    }

    public function save(mixed $data): void
    {
        $this->repository->save($data);
    }

    public function sort(mixed $data, Sort $sort): mixed
    {
        usort($data, static function ($a, $b) use ($sort) {
            if ($a['realName'] === $b['realName']) {
                return 0;
            }

            return ($a['realName'] < $b['realName'] ? -1 : 1) * $sort->value;
        });

        return $data;
    }
}
