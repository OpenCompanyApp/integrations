<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Campaign Monitor integration with Laravel.
 *
 * Binds the API service using host credentials and registers the tool provider
 * when the shared ToolProviderRegistry is available.
 */
class CampaignMonitorServiceProvider extends ServiceProvider
{
    /**
     * Register the Campaign Monitor API service.
     */
    public function register(): void
    {
        $this->app->singleton(CampaignMonitorService::class, function ($app): CampaignMonitorService {
            $creds = $app->make(CredentialResolver::class);

            return new CampaignMonitorService(
                apiKey: $creds->get('campaign-monitor', 'api_key', ''),
                baseUrl: $creds->get('campaign-monitor', 'url', 'https://api.createsend.com/api/v3.3'),
            );
        });
    }

    /**
     * Register the tool provider with the integration registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CampaignMonitorToolProvider());
        }
    }
}
