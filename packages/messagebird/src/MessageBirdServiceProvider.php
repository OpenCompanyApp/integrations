<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the MessageBird integration with Laravel.
 *
 * Binds the REST API service from stored credentials and registers the tool provider.
 */
class MessageBirdServiceProvider extends ServiceProvider
{
    /**
     * Register the MessageBird REST API client.
     */
    public function register(): void
    {
        $this->app->singleton(MessageBirdService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MessageBirdService(
                apiKey: $creds->get('messagebird', 'api_key', ''),
                baseUrl: $creds->get('messagebird', 'url', 'https://rest.messagebird.com'),
            );
        });
    }

    /**
     * Register the tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MessageBirdToolProvider());
        }
    }
}
