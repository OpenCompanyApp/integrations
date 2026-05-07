<?php

namespace OpenCompany\Integrations\Plaid;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Plaid integration with Laravel's service container.
 *
 * Binds PlaidService from host credentials and registers PlaidToolProvider with
 * the shared provider registry when the host exposes it.
 */
class PlaidServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PlaidService::class, function ($app): PlaidService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new PlaidService(
                clientId: $creds?->get('plaid', 'client_id', '') ?? '',
                secret: $creds?->get('plaid', 'secret', '') ?? '',
                plaidVersion: $creds?->get('plaid', 'plaid_version', '2020-09-14') ?? '2020-09-14',
                baseUrl: $creds?->get('plaid', 'url', 'https://sandbox.plaid.com') ?? 'https://sandbox.plaid.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PlaidToolProvider);
        }
    }
}
