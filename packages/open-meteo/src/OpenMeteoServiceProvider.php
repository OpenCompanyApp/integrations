<?php

namespace OpenCompany\Integrations\OpenMeteo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Open-Meteo integration with Laravel's service container.
 *
 * Binds the public OpenMeteoService and registers OpenMeteoToolProvider with
 * the shared registry during boot.
 */
class OpenMeteoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenMeteoService::class, fn (): OpenMeteoService => new OpenMeteoService());
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenMeteoToolProvider);
        }
    }
}
