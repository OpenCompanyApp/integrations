<?php

namespace OpenCompany\Integrations\OpenStreetMap;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenStreetMap integration with Laravel's service container.
 *
 * Binds the public OpenStreetMap service and registers its tool provider with
 * the ToolProviderRegistry during boot.
 */
class OpenStreetMapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenStreetMapService::class, fn (): OpenStreetMapService => new OpenStreetMapService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenStreetMapToolProvider);
        }
    }
}
