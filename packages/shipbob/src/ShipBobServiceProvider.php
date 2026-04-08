<?php

namespace OpenCompany\Integrations\ShipBob;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ShipBobServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShipBobService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ShipBobService(
                accessToken: $creds->get('shipbob', 'access_token', ''),
                baseUrl: $creds->get('shipbob', 'url', 'https://api.shipbob.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ShipBobToolProvider());
        }
    }
}
