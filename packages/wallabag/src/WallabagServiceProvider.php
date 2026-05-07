<?php

namespace OpenCompany\Integrations\Wallabag;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the wallabag integration with Laravel.
 *
 * Binds the wallabag API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class WallabagServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WallabagService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WallabagService(
                accessToken: $creds->get('wallabag', 'access_token', ''),
                clientId: $creds->get('wallabag', 'client_id', ''),
                clientSecret: $creds->get('wallabag', 'client_secret', ''),
                username: $creds->get('wallabag', 'username', ''),
                password: $creds->get('wallabag', 'password', ''),
                refreshToken: $creds->get('wallabag', 'refresh_token', ''),
                baseUrl: $creds->get('wallabag', 'url', 'https://app.wallabag.it'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new WallabagToolProvider());
        }
    }
}
