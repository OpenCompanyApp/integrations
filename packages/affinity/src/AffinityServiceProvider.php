<?php

namespace OpenCompany\Integrations\Affinity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Affinity integration.
 *
 * Registers the AffinityService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class AffinityServiceProvider extends ServiceProvider
{
    /**
     * Register the AffinityService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AffinityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AffinityService(
                apiKey: $creds->get('affinity', 'api_key', ''),
                baseUrl: $creds->get('affinity', 'url', 'https://api.affinity.co'),
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
                ->register(new AffinityToolProvider());
        }
    }
}
