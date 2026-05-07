<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the TrustMRR integration with Laravel's service container.
 *
 * Binds the TrustMrrService using stored credentials and registers the provider for discovery.
 */
class TrustMrrServiceProvider extends ServiceProvider
{
    /**
     * Register the TrustMRR API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TrustMrrService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TrustMrrService(
                apiKey: $creds->get('trustmrr', 'api_key', ''),
            );
        });
    }

    /**
     * Register the TrustMRR tool provider when the registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TrustMrrToolProvider());
        }
    }
}
