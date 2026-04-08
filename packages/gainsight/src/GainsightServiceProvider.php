<?php

namespace OpenCompany\Integrations\Gainsight;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Gainsight integration.
 *
 * Registers the GainsightService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class GainsightServiceProvider extends ServiceProvider
{
    /**
     * Register the GainsightService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GainsightService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GainsightService(
                accessToken: $creds->get('gainsight', 'access_token', ''),
                baseUrl: $creds->get('gainsight', 'url', 'https://api.gainsight.com/v1'),
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
                ->register(new GainsightToolProvider());
        }
    }
}
