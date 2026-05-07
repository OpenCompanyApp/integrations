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
            $accessToken = (string) $creds->get('hubspot', 'access_token', '');
            $baseUrl = (string) $creds->get('hubspot', 'base_url', '');

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('hubspot3', 'access_token', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('hubspot3', 'base_url', 'https://api.hubapi.com');
            }

            return new HubSpotService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
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
