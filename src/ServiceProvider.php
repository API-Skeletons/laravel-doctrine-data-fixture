<?php

declare(strict_types=1);

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

use function config_path;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            $this->getConfigPath() => config_path('doctrine-data-fixtures.php'),
        ], 'config');
    }

    protected function getConfigPath(): string
    {
        return __DIR__ . '/../config/doctrine-data-fixtures.php';
    }
}
