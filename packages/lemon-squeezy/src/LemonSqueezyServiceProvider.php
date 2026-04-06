<?php

namespace OpenCompany\Integrations\LemonSqueezy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LemonSqueezyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LemonSqueezyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LemonSqueezyService(
                apiKey: $creds->get('lemon-squeezy', 'api_key', ''),
                baseUrl: $creds->get('lemon-squeezy', 'url', 'https://api.lemonsqueezy.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LemonSqueezyToolProvider());
        }
    }
}
