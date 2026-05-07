<?php

namespace OpenCompany\Integrations\OneDrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft OneDrive integration with Laravel.
 *
 * Binds the Microsoft Graph client and registers the tool provider when the
 * host exposes the shared ToolProviderRegistry.
 */
class OneDriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OneDriveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('one-drive', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('one_drive', $key, $default);
            };

            return new OneDriveService(
                accessToken: $get('access_token'),
                baseUrl: $get('url', 'https://graph.microsoft.com/v1.0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OneDriveToolProvider());
        }
    }
}
