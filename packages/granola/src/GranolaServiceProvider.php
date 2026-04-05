<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GranolaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GranolaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GranolaService(
                apiKey: $creds->get('granola', 'api_key', ''),
                baseUrl: $creds->get('granola', 'url', 'https://api.granola.ai/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GranolaToolProvider());
        }
    }
}
