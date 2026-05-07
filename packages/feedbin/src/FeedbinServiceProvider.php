<?php

namespace OpenCompany\Integrations\Feedbin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Feedbin integration with Laravel.
 *
 * Binds the Feedbin API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class FeedbinServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FeedbinService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FeedbinService(
                username: $creds->get('feedbin', 'username', ''),
                password: $creds->get('feedbin', 'password', ''),
                baseUrl: $creds->get('feedbin', 'url', 'https://api.feedbin.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new FeedbinToolProvider());
        }
    }
}
