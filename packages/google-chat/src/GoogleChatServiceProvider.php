<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Chat integration with Laravel's service container.
 *
 * Binds GoogleChatService from host credentials and registers the generated
 * GoogleChatToolProvider with the shared provider registry.
 */
class GoogleChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleChatService::class, function ($app): GoogleChatService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleChatService(accessToken: $creds?->get('google-chat', 'access_token', '') ?? '', baseUrl: $creds?->get('google-chat', 'url', 'https://chat.googleapis.com') ?? 'https://chat.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleChatToolProvider);
    }
}
