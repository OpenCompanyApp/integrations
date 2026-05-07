<?php

namespace OpenCompany\Integrations\GoogleDriveActivity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Drive Activity integration with Laravel's service container.
 *
 * Binds GoogleDriveActivityService from host credentials and registers the generated
 * GoogleDriveActivityToolProvider with the shared provider registry.
 */
class GoogleDriveActivityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDriveActivityService::class, function ($app): GoogleDriveActivityService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleDriveActivityService(accessToken: $creds?->get('google-drive-activity', 'access_token', '') ?? '', baseUrl: $creds?->get('google-drive-activity', 'url', 'https://driveactivity.googleapis.com') ?? 'https://driveactivity.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleDriveActivityToolProvider);
    }
}