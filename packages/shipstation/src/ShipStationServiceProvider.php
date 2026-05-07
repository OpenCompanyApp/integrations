<?php

namespace OpenCompany\Integrations\ShipStation;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/** Registers the ShipStation integration with Laravel. */
class ShipStationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShipStationService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new ShipStationService(apiKey: $creds->get('shipstation', 'api_key', ''), baseUrl: $creds->get('shipstation', 'url', 'https://api.shipstation.com'));
        });
    }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new ShipStationToolProvider()); } }
}
