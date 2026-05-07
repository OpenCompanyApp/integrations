<?php

namespace OpenCompany\Integrations\Appetize;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Appetize integration with Laravel.
 *
 * Binds the Appetize API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class AppetizeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AppetizeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AppetizeService(
                apiKey: $creds->get('appetize', 'api_key', ''),
                baseUrl: $creds->get('appetize', 'url', 'https://api.appetize.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AppetizeToolProvider());
        }
    }
}
