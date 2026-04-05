<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Insightly CRM integration.
 *
 * Registers the InsightlyService singleton and bootstraps tool registration
 * with the ToolProviderRegistry when integration-core is available.
 */
class InsightlyServiceProvider extends ServiceProvider
{
    /**
     * Register the InsightlyService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(InsightlyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new InsightlyService(
                apiKey: $creds->get('insightly', 'api_key', ''),
                region: $creds->get('insightly', 'region', 'na1'),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new InsightlyToolProvider());
        }
    }
}
