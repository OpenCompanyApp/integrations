<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Wufoo integration.
 *
 * Registers the WufooService as a singleton using credentials from the
 * CredentialResolver, and boots the WufooToolProvider into the ToolProviderRegistry.
 */
class WufooServiceProvider extends ServiceProvider
{
    /**
     * Register the WufooService singleton and bind credentials.
     */
    public function register(): void
    {
        $this->app->singleton(WufooService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WufooService(
                apiKey: $creds->get('wufoo', 'api_key', ''),
                baseUrl: $creds->get('wufoo', 'base_url', 'https://example.wufoo.com/api/v3'),
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
                ->register(new WufooToolProvider());
        }
    }
}
