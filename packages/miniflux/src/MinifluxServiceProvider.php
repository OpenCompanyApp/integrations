<?php

namespace OpenCompany\Integrations\Miniflux;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Miniflux integration with Laravel.
 *
 * Binds the Miniflux API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class MinifluxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MinifluxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MinifluxService(
                apiKey: $creds->get('miniflux', 'api_key', ''),
                username: $creds->get('miniflux', 'username', ''),
                password: $creds->get('miniflux', 'password', ''),
                baseUrl: $creds->get('miniflux', 'url', 'https://miniflux.example'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new MinifluxToolProvider());
        }
    }
}
