<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MessageBirdServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MessageBirdService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MessageBirdService(
                apiKey: $creds->get('messagebird', 'api_key', ''),
                baseUrl: $creds->get('messagebird', 'url', 'https://api.messagebird.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MessageBirdToolProvider());
        }
    }
}
