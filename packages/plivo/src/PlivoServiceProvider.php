<?php

namespace OpenCompany\Integrations\Plivo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Plivo integration.
 *
 * Registers the PlivoService as a singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available. Supports multi-account credential
 * resolution through the CredentialResolver contract.
 */
class PlivoServiceProvider extends ServiceProvider
{
    /**
     * Register the PlivoService singleton.
     *
     * Resolves credentials from the CredentialResolver and constructs
     * the PlivoService with auth_id and auth_token.
     */
    public function register(): void
    {
        $this->app->singleton(PlivoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PlivoService(
                authId: $creds->get('plivo', 'auth_id', ''),
                authToken: $creds->get('plivo', 'auth_token', ''),
            );
        });
    }

    /**
     * Boot the service provider.
     *
     * Registers the PlivoToolProvider with the ToolProviderRegistry
     * when the registry is bound in the container.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PlivoToolProvider());
        }
    }
}
