<?php

namespace OpenCompany\Integrations\Spotify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register the SpotifyService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SpotifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SpotifyService(
                accessToken: $creds->get('spotify', 'access_token', ''),
                baseUrl: $creds->get('spotify', 'url', 'https://api.spotify.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SpotifyToolProvider());
        }
    }
}
