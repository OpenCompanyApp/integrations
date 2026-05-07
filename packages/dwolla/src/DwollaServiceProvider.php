<?php

namespace OpenCompany\Integrations\Dwolla;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Dwolla integration with Laravel's service container.
 *
 * Binds DwollaService from host credentials and registers the tool provider with
 * the discovery registry when available.
 */
class DwollaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DwollaService::class, function ($app): DwollaService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new DwollaService(
                accessToken: $creds?->get('dwolla', 'access_token', '') ?? '',
                clientId: $creds?->get('dwolla', 'client_id', '') ?? '',
                clientSecret: $creds?->get('dwolla', 'client_secret', '') ?? '',
                baseUrl: $creds?->get('dwolla', 'url', 'https://api-sandbox.dwolla.com') ?? 'https://api-sandbox.dwolla.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DwollaToolProvider);
        }
    }
}
