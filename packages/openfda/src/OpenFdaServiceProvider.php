<?php

namespace OpenCompany\Integrations\OpenFda;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the openFDA integration with Laravel's service container.
 *
 * Binds the public openFDA API service and registers the tool provider with the
 * shared integration registry.
 */
class OpenFdaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenFdaService::class, fn (): OpenFdaService => new OpenFdaService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenFdaToolProvider);
        }
    }
}
