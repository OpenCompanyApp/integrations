<?php

namespace OpenCompany\Integrations\Loom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Loom integration.
 *
 * Registers the LoomService singleton and bootstraps the LoomToolProvider
 * with the ToolProviderRegistry for auto-discovery.
 */
class LoomServiceProvider extends ServiceProvider
{
    /**
     * Register the LoomService singleton into the container.
     */
    public function register(): void
    {
        $this->app->singleton(LoomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LoomService(
                accessToken: $creds->get('loom', 'access_token', ''),
                baseUrl: $creds->get('loom', 'url', 'https://api.loom.com'),
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
                ->register(new LoomToolProvider());
        }
    }
}
