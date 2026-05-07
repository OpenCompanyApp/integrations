<?php

namespace OpenCompany\Integrations\GoogleCloudStorage;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Cloud Storage integration with Laravel's service container.
 *
 * Binds GoogleCloudStorageService from host credentials and registers the
 * generated GoogleCloudStorageToolProvider with the shared provider registry.
 */
class GoogleCloudStorageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleCloudStorageService::class, function ($app): GoogleCloudStorageService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleCloudStorageService(
                accessToken: $creds?->get('google-cloud-storage', 'access_token', '') ?? '',
                baseUrl: $creds?->get('google-cloud-storage', 'url', 'https://storage.googleapis.com/storage/v1') ?? 'https://storage.googleapis.com/storage/v1',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GoogleCloudStorageToolProvider);
        }
    }
}