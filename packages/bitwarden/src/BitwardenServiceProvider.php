<?php

namespace OpenCompany\Integrations\Bitwarden;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Bitwarden integration with Laravel's service container.
 *
 * Binds BitwardenService from host credentials and registers the tool provider
 * with the shared registry when the host exposes one.
 */
class BitwardenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BitwardenService::class, function ($app): BitwardenService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new BitwardenService(
                clientId: $creds?->get('bitwarden', 'client_id', '') ?? '',
                clientSecret: $creds?->get('bitwarden', 'client_secret', '') ?? '',
                accessToken: $creds?->get('bitwarden', 'access_token', '') ?? '',
                baseUrl: $creds?->get('bitwarden', 'api_url', 'https://api.bitwarden.com') ?? 'https://api.bitwarden.com',
                identityUrl: $creds?->get('bitwarden', 'identity_url', 'https://identity.bitwarden.com/connect/token') ?? 'https://identity.bitwarden.com/connect/token',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BitwardenToolProvider);
        }
    }
}