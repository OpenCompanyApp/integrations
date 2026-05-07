<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ChargeOver integration with Laravel's service container.
 *
 * Binds the ChargeOver API client from stored credentials and registers the
 * provider with the shared ToolProviderRegistry during boot.
 */
class ChargeOverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChargeOverService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChargeOverService(
                apiUsername: $creds->get('chargeover', 'api_username', $creds->get('chargeover', 'access_token', '')),
                apiPassword: $creds->get('chargeover', 'api_password', ''),
                subdomain: $creds->get('chargeover', 'subdomain', ''),
                baseUrl: $creds->get('chargeover', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChargeOverToolProvider());
        }
    }
}
