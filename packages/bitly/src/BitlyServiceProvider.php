<?php

namespace OpenCompany\Integrations\Bitly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Bitly integration.
 *
 * Registers the BitlyService as a singleton and bootstraps the
 * BitlyToolProvider with the ToolProviderRegistry for auto-discovery.
 */
class BitlyServiceProvider extends ServiceProvider
{
    /**
     * Register the BitlyService singleton.
     *
     * Resolves the access token from the credential resolver and binds
     * the service instance for dependency injection.
     */
    public function register(): void
    {
        $this->app->singleton(BitlyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BitlyService(
                accessToken: $creds->get('bitly', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the service provider.
     *
     * Registers the BitlyToolProvider with the ToolProviderRegistry
     * if it is available in the application container.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BitlyToolProvider());
        }
    }
}
