<?php

namespace OpenCompany\Integrations\ActiveCampaign;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ActiveCampaign integration.
 *
 * Registers the ActiveCampaignService as a singleton and
 * boots the tool provider into the ToolProviderRegistry.
 */
class ActiveCampaignServiceProvider extends ServiceProvider
{
    /**
     * Register the ActiveCampaign service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ActiveCampaignService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ActiveCampaignService(
                apiKey: $creds->get('activecampaign', 'api_key', ''),
                accountName: $creds->get('activecampaign', 'account_name', ''),
            );
        });
    }

    /**
     * Boot the service provider by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ActiveCampaignToolProvider());
        }
    }
}
