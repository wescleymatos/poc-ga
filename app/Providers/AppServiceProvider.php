<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Eventos\EventoRepositoryInterface;
use App\Infra\Data\Repositories\EventoRepository;
use App\Application\Shared\Services\Logs\LoggerInterface;
use App\Infra\Services\Logs\Logger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventoRepositoryInterface::class, EventoRepository::class);
        $this->app->bind(LoggerInterface::class, Logger::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
