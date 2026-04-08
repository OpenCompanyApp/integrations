<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CampaignMonitorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CampaignMonitorService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CampaignMonitorService(
                apiKey: $creds->get('campaign-monitor', 'api_key', ''),
                baseUrl: $creds->get('campaign-monitor', 'url', 'https://api.createsend.com/api/v3.3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CampaignMonitorToolProvider());
        }
    }
}
