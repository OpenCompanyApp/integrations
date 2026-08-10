<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the PagerDuty integration with Laravel's service container.
 *
 * Binds the PagerDuty API client from host credentials and adds the generated
 * tool provider to the shared integration registry when available.
 */
class PagerdutyServiceProvider extends ServiceProvider
{
    /**
     * Register the PagerDuty API service singleton.
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
     * Register PagerDuty tools with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PagerDutyToolProvider());
        }
    }
}