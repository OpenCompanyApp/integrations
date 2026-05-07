<?php

namespace OpenCompany\Integrations\Copper;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Copper integration with Laravel's service container.
 *
 * Binds CopperService using configured credentials and registers the Copper
 * tool provider with the ToolProviderRegistry when available.
 */
class CopperServiceProvider extends ServiceProvider
{
    /**
     * Register the CopperService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CopperService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CopperService(
                apiKey: $creds->get('copper', 'api_key', ''),
                email: $creds->get('copper', 'email', ''),
                baseUrl: $creds->get('copper', 'url', 'https://api.copper.com/developer_api/v1'),
            );
        });
    }

    /**
     * Boot the provider and register the Copper tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CopperToolProvider());
        }
    }
}
