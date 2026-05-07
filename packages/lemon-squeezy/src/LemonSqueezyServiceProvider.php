<?php

namespace OpenCompany\Integrations\LemonSqueezy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Lemon Squeezy integration with Laravel's service container.
 */
class LemonSqueezyServiceProvider extends ServiceProvider
{
    /**
     * Register the Lemon Squeezy API client singleton.
     */
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

    /**
     * Register the Lemon Squeezy tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LemonSqueezyToolProvider());
        }
    }
}
