<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Typesense integration with Laravel's service container.
 *
 * Binds the Typesense API client from host credentials and adds the generated
 * tool provider to the shared integration registry when available.
 */
class TypesenseServiceProvider extends ServiceProvider
{
    /**
     * Register the Typesense API service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TypesenseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TypesenseService(
                apiKey: $creds->get('typesense', 'api_key', ''),
                baseUrl: $creds->get('typesense', 'url', 'http://localhost:8108'),
            );
        });
    }

    /**
     * Register Typesense tools with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new TypesenseToolProvider());
        }
    }
}
