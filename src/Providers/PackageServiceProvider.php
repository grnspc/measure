<?php

declare(strict_types=1);

namespace Grnspc\Measures\Providers;

use Grnspc\Measures\Contracts\Measures as MeasuresInterface;
use Grnspc\Measures\Measures;
use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->mergeConfig();

        $this->app->bind(MeasuresInterface::class, function () {
            return new Measures;
        });
    }

    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(
            path: $this->getConfigPath(),
            key: 'measures'
        );
    }

    private function getConfigPath(): string
    {
        return __DIR__ . '/../../config/config.php';
    }

    public function boot(): void
    {

        $this->publishConfig();

    }

    // private function publishMigrations(): void
    // {
    //     $path = $this->getMigrationsPath();
    //     $this->publishes([$path => database_path('migrations')], 'migrations');
    // }

    private function publishConfig(): void
    {
        $this->publishes(
            paths: [
                $this->getConfigPath() => config_path('media.php'),
            ],
            groups: 'config'
        );
    }

    // private function getMigrationsPath(): string
    // {
    //     return __DIR__ . '/../database/migrations/';
    // }
}
