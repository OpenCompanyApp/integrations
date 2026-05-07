<?php

namespace OpenCompany\Integrations\Delighted;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Delighted integration with Laravel.
 *
 * Binds the Delighted API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class DelightedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DelightedService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DelightedService(
                apiKey: $creds->get('delighted', 'api_key', ''),
                baseUrl: $creds->get('delighted', 'url', 'https://api.delighted.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DelightedToolProvider());
        }
    }
}
