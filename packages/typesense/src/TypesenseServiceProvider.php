<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TypesenseServiceProvider extends ServiceProvider
{
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

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TypesenseToolProvider());
        }
    }
}
