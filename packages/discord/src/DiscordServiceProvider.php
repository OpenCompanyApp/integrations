<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Discord integration.
 *
 * Registers the DiscordService singleton and bootstraps the Discord tool provider.
 */
class DiscordServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DiscordService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DiscordService(
                botToken: $creds->get('discord', 'bot_token', ''),
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
