<?php

declare(strict_types=1);

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures;

use ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands\ImportCommand;
use ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands\ListCommand;
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

        $this->commands([
            ListCommand::class,
            ImportCommand::class,
        ]);
    }

    protected function getConfigPath(): string
    {
        return __DIR__ . '/../config/doctrine-data-fixtures.php';
    }
}
