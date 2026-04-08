<?php

namespace OpenCompany\Integrations\Freshmarketer;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * FreshmarketerServiceProvider — Laravel service provider for the Freshmarketer integration.
 *
 * Registers the FreshmarketerService singleton, resolves credentials via the
 * CredentialResolver, and auto-discovers tools through the ToolProviderRegistry.
 */
class FreshmarketerServiceProvider extends ServiceProvider
{
    /**
     * Register the FreshmarketerService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FreshmarketerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshmarketerService(
                accessToken: $creds->get('freshmarketer', 'access_token', ''),
                domain: $creds->get('freshmarketer', 'domain', ''),
                baseUrl: $creds->get('freshmarketer', 'base_url', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshmarketerToolProvider());
        }
    }
}
