<?php

namespace OpenCompany\Integrations\Weaviate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WeaviateServiceProvider extends ServiceProvider
{
    /**
     * Register the Weaviate service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WeaviateService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WeaviateService(
                apiKey: $creds->get('weaviate', 'api_key', ''),
                baseUrl: $creds->get('weaviate', 'url', 'http://localhost:8080/v1'),
            );
        });
    }

    /**
     * Boot the Weaviate service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WeaviateToolProvider());
        }
    }
}
