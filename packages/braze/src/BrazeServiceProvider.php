<?php

namespace OpenCompany\Integrations\Braze;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Braze integration.
 *
 * Registers the BrazeService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry for auto-discovery.
 */
class BrazeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrazeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BrazeService(
                apiKey: $creds->get('braze', 'api_key', ''),
                baseUrl: $creds->get('braze', 'url', 'https://rest.iad-01.braze.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BrazeToolProvider());
        }
    }
}
