<?php

namespace OpenCompany\Integrations\Milvus;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MilvusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MilvusService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MilvusService(
                apiKey: $creds->get('milvus', 'api_key', ''),
                baseUrl: $creds->get('milvus', 'url', 'https://api.milvus.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MilvusToolProvider());
        }
    }
}
