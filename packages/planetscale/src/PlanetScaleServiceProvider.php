<?php

namespace OpenCompany\Integrations\PlanetScale;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PlanetScaleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PlanetScaleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PlanetScaleService(
                accessToken: $creds->get('planetscale', 'access_token', ''),
                baseUrl: $creds->get('planetscale', 'url', 'https://api.planetscale.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PlanetScaleToolProvider());
        }
    }
}
