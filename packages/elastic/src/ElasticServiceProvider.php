<?php

namespace OpenCompany\Integrations\Elastic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ElasticServiceProvider extends ServiceProvider
{
    /**
     * Register the ElasticService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ElasticService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ElasticService(
                baseUrl: $creds->get('elastic', 'url', 'http://localhost:9200'),
                apiKey: $creds->get('elastic', 'api_key'),
                username: $creds->get('elastic', 'username'),
                password: $creds->get('elastic', 'password'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ElasticToolProvider());
        }
    }
}
