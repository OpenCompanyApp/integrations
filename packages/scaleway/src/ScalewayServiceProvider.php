<?php

namespace OpenCompany\Integrations\Scaleway;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ScalewayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ScalewayService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ScalewayService(
                accessToken: $creds->get('scaleway', 'access_token', ''),
                baseUrl: $creds->get('scaleway', 'url', 'https://api.scaleway.com/instance/v1/zones/fr-par-1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ScalewayToolProvider());
        }
    }
}
