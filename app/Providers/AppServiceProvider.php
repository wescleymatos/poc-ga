<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Eventos\EventoRepositoryInterface;
use App\Infra\Data\Repositories\EventoRepository;
use App\Application\Shared\Services\Logs\LoggerInterface;
use App\Infra\Services\Logs\Logger;
use App\Infra\Data\UnitOfWork\UnitOfWork;
use App\Application\Shared\Services\UnitOfWork\UnitOfWorkInterface;
use App\Domain\Auditorias\AuditoriaRepositoryInterface;
use App\Infra\Data\Repositories\AuditoriaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(EventoRepositoryInterface::class, EventoRepository::class);
        $this->app->bind(AuditoriaRepositoryInterface::class, AuditoriaRepository::class);

        // Services
        $this->app->bind(LoggerInterface::class, Logger::class);
        $this->app->singleton(UnitOfWorkInterface::class, UnitOfWork::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
