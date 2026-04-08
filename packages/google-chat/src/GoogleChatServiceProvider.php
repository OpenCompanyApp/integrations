<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleChatService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleChatService(
                accessToken: $creds->get('google-chat', 'access_token', ''),
                baseUrl: $creds->get('google-chat', 'url', 'https://chat.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleChatToolProvider());
        }
    }
}
