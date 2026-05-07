<?php

namespace OpenCompany\Integrations\Canny;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Canny integration with Laravel.
 *
 * Binds the Canny API client from host credentials and registers the Canny tool
 * provider with the shared registry when available.
 */
class CannyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CannyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CannyService(
                apiKey: $creds->get('canny', 'api_key', ''),
                baseUrl: $creds->get('canny', 'url', 'https://canny.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CannyToolProvider());
        }
    }
}
