<?php

namespace OpenCompany\Integrations\Freshchat;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshchatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshchatService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshchatService(
                accessToken: $creds->get('freshchat', 'access_token', ''),
                baseUrl: $creds->get('freshchat', 'url', 'https://api.freshchat.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshchatToolProvider());
        }
    }
}
