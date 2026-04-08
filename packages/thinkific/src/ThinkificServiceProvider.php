<?php

namespace OpenCompany\Integrations\Thinkific;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Thinkific integration.
 *
 * Registers the ThinkificService singleton and bootstraps tool discovery
 * via the ToolProviderRegistry.
 */
class ThinkificServiceProvider extends ServiceProvider
{
    /**
     * Register the ThinkificService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ThinkificService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ThinkificService(
                apiKey: $creds->get('thinkific', 'api_key', ''),
                subdomain: $creds->get('thinkific', 'subdomain', ''),
                baseUrl: $creds->get('thinkific', 'url', 'https://api.thinkific.com/api/public/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the Thinkific tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ThinkificToolProvider());
        }
    }
}
