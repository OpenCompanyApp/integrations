<?php

namespace OpenCompany\Integrations\Hubspot3;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the Hubspot3Service singleton and bootstraps HubSpot tools.
 */
class Hubspot3ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Hubspot3Service::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new Hubspot3Service(
                accessToken: $creds->get('hubspot3', 'access_token', ''),
                baseUrl: $creds->get('hubspot3', 'base_url', 'https://api.hubapi.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new Hubspot3ToolProvider());
        }
    }
}
