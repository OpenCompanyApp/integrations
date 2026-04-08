<?php

namespace OpenCompany\Integrations\Zuora;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zuora integration.
 *
 * Registers the ZuoraService as a singleton and bootstraps the ZuoraToolProvider
 * with the ToolProviderRegistry for auto-discovery.
 */
class ZuoraServiceProvider extends ServiceProvider
{
    /**
     * Register the ZuoraService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZuoraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZuoraService(
                accessToken: $creds->get('zuora', 'access_token', ''),
                baseUrl: $creds->get('zuora', 'base_url', 'https://rest.zuora.com/v2'),
            );
        });
    }

    /**
     * Boot the Zuora tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZuoraToolProvider());
        }
    }
}
