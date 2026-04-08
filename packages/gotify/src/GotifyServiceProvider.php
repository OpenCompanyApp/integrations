<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GotifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GotifyService(
                appToken: $creds->get('gotify', 'app_token', ''),
                baseUrl: $creds->get('gotify', 'hostname', 'https://gotify.example.com'),
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
