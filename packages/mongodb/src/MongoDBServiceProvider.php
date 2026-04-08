<?php

namespace OpenCompany\Integrations\MongoDB;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MongoDBServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MongoDBService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MongoDBService(
                apiKey: $creds->get('mongodb', 'api_key', ''),
                clusterUrl: $creds->get('mongodb', 'cluster_url', ''),
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
