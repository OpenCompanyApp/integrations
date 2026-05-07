<?php

namespace OpenCompany\Integrations\GoogleVault;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Vault integration with Laravel's service container.
 *
 * Binds GoogleVaultService from host credentials and registers the generated
 * GoogleVaultToolProvider with the shared provider registry.
 */
class GoogleVaultServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleVaultService::class, function ($app): GoogleVaultService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleVaultService(accessToken: $creds?->get('google-vault', 'access_token', '') ?? '', baseUrl: $creds?->get('google-vault', 'url', 'https://vault.googleapis.com') ?? 'https://vault.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleVaultToolProvider);
    }
}