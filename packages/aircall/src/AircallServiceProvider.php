<?php

namespace OpenCompany\Integrations\Aircall;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Aircall integration.
 *
 * Registers the AircallService as a singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available. Supports multi-account credential
 * resolution through the CredentialResolver contract.
 */
class AircallServiceProvider extends ServiceProvider
{
    /**
     * Register the AircallService singleton.
     *
     * Resolves credentials from the CredentialResolver and constructs
     * the AircallService with Basic Auth or OAuth bearer credentials.
     */
    public function register(): void
    {
        $this->app->singleton(AircallService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AircallService(
                accessToken: $creds->get('aircall', 'access_token', ''),
                baseUrl: $creds->get('aircall', 'url', 'https://api.aircall.io'),
                apiId: $creds->get('aircall', 'api_id', ''),
                apiToken: $creds->get('aircall', 'api_token', $creds->get('aircall', 'api_key', '')),
            );
        });
    }

    /**
     * Boot the service provider.
     *
     * Registers the AircallToolProvider with the ToolProviderRegistry
     * when the registry is bound in the container.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AircallToolProvider());
        }
    }
}
