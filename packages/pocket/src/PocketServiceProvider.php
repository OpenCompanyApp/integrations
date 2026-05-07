<?php

namespace OpenCompany\Integrations\Pocket;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pocket integration with Laravel.
 *
 * Binds the Pocket API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class PocketServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PocketService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PocketService(
                consumerKey: $creds->get('pocket', 'consumer_key', ''),
                accessToken: $creds->get('pocket', 'access_token', ''),
                baseUrl: $creds->get('pocket', 'url', 'https://getpocket.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PocketToolProvider());
        }
    }
}
