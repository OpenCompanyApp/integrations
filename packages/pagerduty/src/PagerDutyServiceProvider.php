<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the PagerDuty integration.
 *
 * Registers the PagerdutyService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class PagerdutyServiceProvider extends ServiceProvider
{
    /**
     * Register the PagerdutyService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(PagerdutyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PagerdutyService(
                apiToken: $creds->get('pagerduty', 'api_token', ''),
                baseUrl: $creds->get('pagerduty', 'base_url', 'https://api.pagerduty.com'),
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
                ->register(new PagerdutyToolProvider());
        }
    }
}
