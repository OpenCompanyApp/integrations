<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Drive integration with Laravel's service container.
 *
 * Binds GoogleDriveService from host credentials and registers the generated
 * GoogleDriveToolProvider with the shared provider registry.
 */
class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDriveService::class, function ($app): GoogleDriveService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleDriveService(accessToken: $creds?->get('google-drive', 'access_token', '') ?? '', baseUrl: $creds?->get('google-drive', 'url', 'https://www.googleapis.com') ?? 'https://www.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleDriveToolProvider);
    }
}
