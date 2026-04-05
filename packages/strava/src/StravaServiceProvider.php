<?php

namespace OpenCompany\Integrations\Strava;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class StravaServiceProvider extends ServiceProvider
{
    /**
     * Register the Strava service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(StravaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StravaService(
                accessToken: $creds->get('strava', 'access_token', ''),
                baseUrl: $creds->get('strava', 'url', 'https://www.strava.com/api/v3'),
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
                ->register(new StravaToolProvider());
        }
    }
}
