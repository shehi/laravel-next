<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\CardRepository;
use App\Repositories\RepositoryInterface;
use App\Services\CardService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        CardService::class => CardService::class,
        RepositoryInterface::class => CardRepository::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
