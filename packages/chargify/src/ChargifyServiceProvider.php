<?php

namespace OpenCompany\Integrations\Chargify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Chargify integration with Laravel's service container.
 *
 * Binds the Maxio Advanced Billing API client from stored credentials and
 * registers the Chargify tool provider during boot.
 */
class ChargifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChargifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChargifyService(
                apiKey: $creds->get('chargify', 'api_key', ''),
                subdomain: $creds->get('chargify', 'subdomain', ''),
                baseUrl: $creds->get('chargify', 'url', ''),
                apiPassword: $creds->get('chargify', 'api_password', 'x'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChargifyToolProvider());
        }
    }
}
