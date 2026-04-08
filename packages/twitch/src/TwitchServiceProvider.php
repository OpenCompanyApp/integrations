<?php

namespace OpenCompany\Integrations\Twitch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TwitchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TwitchService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TwitchService(
                accessToken: $creds->get('twitch', 'access_token', ''),
                clientId: $creds->get('twitch', 'client_id', ''),
                baseUrl: $creds->get('twitch', 'base_url', 'https://api.twitch.tv/helix'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TwitchToolProvider());
        }
    }
}
