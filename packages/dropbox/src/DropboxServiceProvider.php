<?php

namespace OpenCompany\Integrations\Dropbox;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Dropbox integration with Laravel's service container.
 *
 * Binds the DropboxService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class DropboxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DropboxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new DropboxService(
                accessToken: $creds->get('dropbox', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DropboxToolProvider());
        }
    }
}
