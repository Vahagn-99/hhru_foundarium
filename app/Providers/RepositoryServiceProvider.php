<?php

namespace App\Providers;

use App\Repositories\CarRepository;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * The best think in laravel
     * @const array<string
     */
    private const PROVIDES = [
        CarRepositoryInterface::class => CarRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach (self::PROVIDES as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
