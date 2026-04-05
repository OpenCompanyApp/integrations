<?php

namespace OpenCompany\Integrations\Ghost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GhostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GhostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GhostService(
                apiKey: $creds->get('ghost', 'api_key', ''),
                baseUrl: $creds->get('ghost', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GhostToolProvider());
        }
    }
}
