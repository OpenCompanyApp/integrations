<?php

namespace OpenCompany\Integrations\AfterShip;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the AfterShip integration with Laravel's service container.
 *
 * Binds AfterShipService using host credentials and registers the tool
 * provider with the ToolProviderRegistry during boot.
 */
class AfterShipServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AfterShipService::class, function ($app): AfterShipService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AfterShipService(apiKey: $creds?->get('aftership', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AfterShipToolProvider);
        }
    }
}
