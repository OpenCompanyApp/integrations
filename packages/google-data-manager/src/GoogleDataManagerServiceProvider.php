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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds?->get('google-data-manager', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : ($creds?->get('google_data_manager', $key, $default) ?? $default);
            };

            $expiresAt = $get('expires_at', null);

            return new GoogleDataManagerService(
                clientId: $get('client_id'),
                clientSecret: $get('client_secret'),
                accessToken: $get('access_token'),
                refreshToken: $get('refresh_token'),
                expiresAt: is_numeric($expiresAt) ? (int) $expiresAt : null,
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
