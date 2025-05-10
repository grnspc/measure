<?php

namespace Grnspc\Measures\Tests;

use Grnspc\Measures\Providers\PackageServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Grnspc\\Measures\\Tests\\database\\factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //        artisan($this, 'migrate', ['--database' => 'testbench']);
        //
        //        $this->beforeApplicationDestroyed(
        //            fn () => artisan($this, 'migrate:rollback', ['--database' => 'testbench'])
        //        );
    }
}
