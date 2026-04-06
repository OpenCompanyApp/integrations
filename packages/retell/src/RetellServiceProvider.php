<?php

namespace OpenCompany\Integrations\Retell;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Retell AI integration.
 *
 * Registers the RetellService as a singleton and bootstraps
 * the ToolProvider with the ToolProviderRegistry.
 */
class RetellServiceProvider extends ServiceProvider
{
    /**
     * Register the RetellService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RetellService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RetellService(
                accessToken: $creds->get('retell', 'access_token', ''),
                baseUrl: $creds->get('retell', 'url', 'https://api.retellai.com'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RetellToolProvider());
        }
    }
}
