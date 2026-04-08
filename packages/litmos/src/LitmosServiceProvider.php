<?php

namespace OpenCompany\Integrations\Litmos;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Litmos integration.
 *
 * Registers the LitmosService singleton and bootstraps tool discovery
 * via the ToolProviderRegistry.
 */
class LitmosServiceProvider extends ServiceProvider
{
    /**
     * Register the LitmosService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(LitmosService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LitmosService(
                apiKey: $creds->get('litmos', 'api_key', ''),
                baseUrl: $creds->get('litmos', 'url', 'https://api.litmos.com'),
            );
        });
    }

    /**
     * Boot the service provider and register the Litmos tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LitmosToolProvider());
        }
    }
}
