<?php

namespace OpenCompany\Integrations\Meilisearch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MeilisearchServiceProvider extends ServiceProvider
{
    /**
     * Register the Meilisearch service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MeilisearchService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MeilisearchService(
                apiKey: $creds->get('meilisearch', 'api_key', ''),
                baseUrl: $creds->get('meilisearch', 'url', 'http://localhost:7700'),
            );
        });
    }

    /**
     * Boot the Meilisearch service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MeilisearchToolProvider());
        }
    }
}
