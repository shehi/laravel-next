<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Facades\Log;

class CardRepository implements RepositoryInterface
{
    /**
     * @throws \JsonException
     */
    public function fetch(): mixed
    {
        $raw = file_get_contents('https://opensource.aoe.com/the-card-game-data/player.json');

        return json_decode($raw, true, 512, \JSON_THROW_ON_ERROR);
    }

    public function save(mixed $data): void
    {
        Log::debug('Submit successful.');
    }
}
