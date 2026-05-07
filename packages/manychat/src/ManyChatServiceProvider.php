<?php

namespace OpenCompany\Integrations\ManyChat;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Manychat integration with Laravel's service container.
 *
 * Binds the API client with stored credentials and registers the tool provider
 * with the shared registry when the host has integration-core loaded.
 */
class ManyChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ManyChatService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ManyChatService(
                apiKey: $creds->get('manychat', 'api_key', ''),
                baseUrl: $creds->get('manychat', 'url', 'https://api.manychat.com'),
                profileApiKey: $creds->get('manychat', 'profile_api_key', ''),
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
