<?php

namespace OpenCompany\Integrations\Fathom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Fathom Analytics integration.
 *
 * Registers the FathomService as a singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class FathomServiceProvider extends ServiceProvider
{
    /**
     * Register the FathomService singleton with credentials from the CredentialResolver.
     */
    public function register(): void
    {
        $this->app->singleton(FathomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FathomService(
                accessToken: $creds->get('fathom', 'access_token', ''),
                baseUrl: $creds->get('fathom', 'url', 'https://api.usefathom.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the FathomToolProvider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FathomToolProvider());
        }
    }
}
