<?php

namespace OpenCompany\Integrations\Postman;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Postman integration with Laravel.
 *
 * Binds PostmanService using host credentials and registers the tool provider
 * with the shared registry when available.
 */
class PostmanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PostmanService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new PostmanService(
                apiKey: $creds->get('postman', 'api_key', ''),
                baseUrl: $creds->get('postman', 'url', 'https://api.getpostman.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PostmanToolProvider());
        }
    }
}
