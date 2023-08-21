<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Sort;
use App\Repositories\CardRepository;
use Illuminate\Support\Facades\Log;
use JsonException;

class CardService implements ServiceInterface, SortableInterface
{
    public function __construct(private readonly CardRepository $repository)
    {
    }

    /**
     * @throws JsonException
     */
    public function fetch(): mixed
    {
        $raw = $this->repository->fetch();

        return json_decode($raw, true, 512, \JSON_THROW_ON_ERROR);
    }

    public function save(mixed $data): void
    {
        Log::info('Submit successful.');
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
