<?php

namespace OpenCompany\Integrations\MongoDB;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the MongoDB Atlas Data API integration with Laravel.
 *
 * Binds the API client from configured credentials and registers the tool
 * provider with the shared integration registry.
 */
class MongoDBServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MongoDBService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MongoDBService(
                apiKey: $creds->get('mongodb', 'api_key', ''),
                clusterUrl: $creds->get('mongodb', 'cluster_url', ''),
                dataSource: $creds->get('mongodb', 'data_source', 'mongodb-atlas'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MongoDBToolProvider());
        }
    }
}
