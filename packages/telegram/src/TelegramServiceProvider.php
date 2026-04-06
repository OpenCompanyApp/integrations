<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Telegram Bot integration.
 *
 * Registers the TelegramService singleton and auto-discovers
 * the TelegramToolProvider with the ToolProviderRegistry.
 */
class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Register the TelegramService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TelegramService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TelegramService(
                botToken: $creds->get('telegram', 'bot_token', ''),
                baseUrl: $creds->get('telegram', 'url', 'https://api.telegram.org'),
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
                ->register(new TelegramToolProvider());
        }
    }
}
