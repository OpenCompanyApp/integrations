<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Gotify integration with Laravel's service container.
 *
 * Binds GotifyService using application and client tokens, then registers the tool provider on boot.
 */
class GotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GotifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GotifyService(
                appToken: $creds->get('gotify', 'app_token', ''),
                baseUrl: $creds->get('gotify', 'hostname', 'https://gotify.example.com'),
                clientToken: $creds->get('gotify', 'client_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GotifyToolProvider());
        }
    }
}
