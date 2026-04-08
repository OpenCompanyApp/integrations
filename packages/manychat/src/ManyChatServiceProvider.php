<?php

namespace OpenCompany\Integrations\ManyChat;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ManyChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ManyChatService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ManyChatService(
                apiKey: $creds->get('manychat', 'api_key', ''),
                baseUrl: $creds->get('manychat', 'url', 'https://api.manychat.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ManyChatToolProvider());
        }
    }
}
