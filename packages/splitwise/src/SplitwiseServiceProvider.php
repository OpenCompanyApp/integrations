<?php

namespace OpenCompany\Integrations\Splitwise;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * SplitwiseServiceProvider — Laravel service provider for the Splitwise integration.
 *
 * Registers the SplitwiseService singleton with credentials resolved from the
 * integration-core CredentialResolver, and auto-registers the ToolProvider
 * with the ToolProviderRegistry when available.
 */
class SplitwiseServiceProvider extends ServiceProvider
{
    /**
     * Register the SplitwiseService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SplitwiseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SplitwiseService(
                accessToken: $creds->get('splitwise', 'access_token', ''),
                baseUrl: $creds->get('splitwise', 'url', 'https://secure.splitwise.com/api/v3.0'),
            );
        });
    }

    /**
     * Boot the service provider — register the ToolProvider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SplitwiseToolProvider());
        }
    }
}
