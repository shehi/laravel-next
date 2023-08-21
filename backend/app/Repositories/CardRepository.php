<?php

declare(strict_types=1);

namespace App\Repositories;

class CardRepository implements RepositoryInterface
{
    public function fetch(): string
    {
        return file_get_contents('https://opensource.aoe.com/the-card-game-data/player.json');
    }

    public function save(mixed $data): void
    {
        // Do nothing.
    }
}
