<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ChromaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChromaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChromaService(
                apiKey: $creds->get('chroma', 'api_key', ''),
                baseUrl: $creds->get('chroma', 'url', 'http://localhost:8000/api/v1'),
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
