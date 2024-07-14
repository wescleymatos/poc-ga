<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Eventos\EventoRepositoryInterface;
use App\Infra\Data\Repositories\EventoRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventoRepositoryInterface::class, EventoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
