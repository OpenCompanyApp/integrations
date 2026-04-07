<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TelegramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TelegramService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TelegramService(
                accessToken: $creds->get('telegram', 'access_token', ''),
                baseUrl: $creds->get('telegram', 'url', 'https://api.telegram.org'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TelegramToolProvider());
        }
    }
}
