<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the DiscordService singleton and bootstraps Discord tools.
 */
class DiscordServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DiscordService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DiscordService(
                accessToken: $creds->get('discord', 'access_token', ''),
                baseUrl: $creds->get('discord', 'base_url', 'https://discord.com/api/v10'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DiscordToolProvider());
        }
    }
}
