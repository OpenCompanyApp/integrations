<?php

namespace OpenCompany\Integrations\Shippo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Shippo integration with Laravel's service container.
 *
 * Binds ShippoService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class ShippoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShippoService::class, function ($app): ShippoService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new ShippoService(
                apiToken: $creds?->get('shippo', 'api_token', '') ?? '',
                baseUrl: $creds?->get('shippo', 'url', 'https://api.goshippo.com') ?? 'https://api.goshippo.com',
                apiVersion: $creds?->get('shippo', 'api_version', '2018-02-08') ?? '2018-02-08',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ShippoToolProvider);
        }
    }
}
