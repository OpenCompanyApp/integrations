<?php

namespace OpenCompany\Integrations\Replicate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Replicate integration with Laravel.
 *
 * Binds the HTTP API client from configured credentials and registers the
 * generated OpenAPI tool provider with the shared registry.
 */
class ReplicateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ReplicateService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ReplicateService(
                apiKey: $creds->get('replicate', 'api_key', ''),
                baseUrl: $creds->get('replicate', 'url', 'https://api.replicate.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ReplicateToolProvider());
        }
    }
}
