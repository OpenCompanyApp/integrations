<?php

namespace OpenCompany\Integrations\HubSpot;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the HubSpotService singleton and bootstraps HubSpot tools.
 */
class HubSpotServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HubSpotService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HubSpotService(
                accessToken: $creds->get('hubspot', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HubSpotToolProvider());
        }
    }
}
