<?php

namespace OpenCompany\Integrations\Radar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RadarServiceProvider extends ServiceProvider
{
    /**
     * Register the Radar service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RadarService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RadarService(
                accessToken: $creds->get('radar', 'access_token', ''),
                baseUrl: $creds->get('radar', 'url', 'https://api.radar.io/v1'),
            );
        });
    }

    /**
     * Boot the Radar integration by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RadarToolProvider());
        }
    }
}
