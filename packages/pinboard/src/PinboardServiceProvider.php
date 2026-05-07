<?php

namespace OpenCompany\Integrations\Pinboard;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pinboard integration with Laravel.
 *
 * Binds the Pinboard API client from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class PinboardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PinboardService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PinboardService(
                authToken: $creds->get('pinboard', 'auth_token', ''),
                baseUrl: $creds->get('pinboard', 'url', 'https://api.pinboard.in/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PinboardToolProvider());
        }
    }
}
