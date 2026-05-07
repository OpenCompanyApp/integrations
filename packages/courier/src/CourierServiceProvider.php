<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Courier integration with Laravel's service container.
 *
 * Binds CourierService using credentials from CredentialResolver and registers
 * CourierToolProvider when the host exposes a ToolProviderRegistry.
 */
class CourierServiceProvider extends ServiceProvider
{
    /**
     * Register the Courier API client.
     */
    public function register(): void
    {
        $this->app->singleton(CourierService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CourierService(
                apiKey: $creds->get('courier', 'api_key', ''),
                baseUrl: $creds->get('courier', 'url', 'https://api.courier.com'),
            );
        });
    }

    /**
     * Register the Courier tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CourierToolProvider());
        }
    }
}
