<?php

namespace OpenCompany\Integrations\Qdrant;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class QdrantServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(QdrantService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new QdrantService(
                apiKey: $creds->get('qdrant', 'api_key', ''),
                baseUrl: $creds->get('qdrant', 'url', 'https://your-cluster-url.qdrant.tech:6333'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new QdrantToolProvider());
        }
    }
}
