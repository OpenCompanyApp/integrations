<?php

namespace OpenCompany\Integrations\Nasa;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the NASA integration with Laravel.
 *
 * Binds the NASA API service and registers NASA tools with the shared registry.
 */
class NasaServiceProvider extends ServiceProvider
{
    /**
     * Register the NasaService singleton.
     *
     * Reads the NASA API key and base URL from config. Falls back to the
     * public DEMO_KEY and https://api.nasa.gov when no config is provided.
     */
    public function register(): void
    {
        $this->app->singleton(NasaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NasaService(
                apiKey: $creds->get('nasa', 'api_key', 'DEMO_KEY'),
                baseUrl: $creds->get('nasa', 'url', 'https://api.nasa.gov'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NasaToolProvider);
        }
    }
}
