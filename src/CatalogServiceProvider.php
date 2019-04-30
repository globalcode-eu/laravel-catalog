<?php

namespace GlobalCode\LaravelCatalog;

use GlobalCode\LaravelCatalog\Commands\Import;
use GlobalCode\LaravelCatalog\Commands\MakeCatalog;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCatalog::class,
                Import::class,
            ]);
        }
    }
}
