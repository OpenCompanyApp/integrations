<?php

namespace OpenCompany\Integrations\GoogleDataManager;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Data Manager integration with Laravel.
 *
 * Binds the API service from host credentials and registers the tool provider
 * for discovery in OpenCompany and KosmoKrator.
 */
class GoogleDataManagerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDataManagerService::class, function ($app) {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GoogleDataManagerService(
                clientId: $creds?->get('google_data_manager', 'client_id', '') ?? '',
                clientSecret: $creds?->get('google_data_manager', 'client_secret', '') ?? '',
                accessToken: $creds?->get('google_data_manager', 'access_token', '') ?? '',
                refreshToken: $creds?->get('google_data_manager', 'refresh_token', '') ?? '',
                expiresAt: $creds?->get('google_data_manager', 'expires_at', null),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register($this->app->make(GoogleDataManagerToolProvider::class));
        }
    }
}
