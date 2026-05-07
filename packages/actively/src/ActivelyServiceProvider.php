<?php

namespace OpenCompany\Integrations\Actively;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Actively integration.
 *
 * Registers the ActivelyService as a singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class ActivelyServiceProvider extends ServiceProvider
{
    /**
     * Register the ActivelyService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ActivelyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ActivelyService(
                accessToken: $creds->get('actively', 'access_token', ''),
                baseUrl: $creds->get('actively', 'url', 'https://api.actively.com'),
            );
        });
    }

    /**
     * Boot the service provider - register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ActivelyToolProvider());
        }
    }
}
