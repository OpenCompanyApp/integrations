<?php

namespace OpenCompany\Integrations\DataCite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the DataCite integration with Laravel's service container.
 *
 * Binds the public DataCite service and registers the provider with the shared
 * discovery registry.
 */
class DataCiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DataCiteService::class, fn (): DataCiteService => new DataCiteService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DataCiteToolProvider);
        }
    }
}
