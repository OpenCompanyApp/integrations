<?php

namespace OpenCompany\Integrations\Wise;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Wise integration.
 *
 * Registers the WiseService as a singleton resolved from CredentialResolver
 * and boots the WiseToolProvider into the ToolProviderRegistry.
 */
class WiseServiceProvider extends ServiceProvider
{
    /**
     * Register the WiseService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(WiseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WiseService(
                apiKey: $creds->get('wise', 'api_key', ''),
                baseUrl: $creds->get('wise', 'url', 'https://api.transferwise.com'),
            );
        });
    }

    /**
     * Boot the Wise tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WiseToolProvider());
        }
    }
}
