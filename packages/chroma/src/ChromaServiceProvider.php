<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Chroma integration with Laravel.
 *
 * Binds the v2 REST API client from stored credentials and registers the
 * provider with the shared ToolProviderRegistry when available.
 */
class ChromaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChromaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChromaService(
                apiKey: $creds->get('chroma', 'api_key', ''),
                baseUrl: $creds->get('chroma', 'url', 'http://localhost:8000'),
                tenant: $creds->get('chroma', 'tenant', 'default_tenant'),
                database: $creds->get('chroma', 'database', 'default_database'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChromaToolProvider());
        }
    }
}
