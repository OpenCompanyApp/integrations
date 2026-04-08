<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Google Drive integration.
 *
 * Registers the GoogleDriveService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDriveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleDriveService(
                accessToken: $creds->get('google-drive', 'access_token', ''),
                baseUrl: $creds->get('google-drive', 'url', 'https://www.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleDriveToolProvider());
        }
    }
}
