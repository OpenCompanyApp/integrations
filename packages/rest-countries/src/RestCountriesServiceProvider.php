<?php

namespace OpenCompany\Integrations\RestCountries;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the REST Countries integration with Laravel's service container.
 *
 * Binds the public API client and registers the tool provider with the shared
 * ToolProviderRegistry during boot.
 */
class RestCountriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RestCountriesService::class, fn (): RestCountriesService => new RestCountriesService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new RestCountriesToolProvider);
        }
    }
}
