<?php

namespace OpenCompany\Integrations\ShipEngine;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ShipEngine integration with Laravel's service container.
 *
 * Binds ShipEngineService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class ShipEngineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShipEngineService::class, function ($app): ShipEngineService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new ShipEngineService(
                apiKey: $creds?->get('shipengine', 'api_key', '') ?? '',
                baseUrl: $creds?->get('shipengine', 'url', 'https://api.shipengine.com') ?? 'https://api.shipengine.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ShipEngineToolProvider);
        }
    }
}
