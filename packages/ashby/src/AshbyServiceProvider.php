<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AshbyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AshbyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AshbyService(
                apiKey: $creds->get('ashby', 'api_key', ''),
                baseUrl: $creds->get('ashby', 'url', 'https://api.ashbyhq.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AshbyToolProvider());
        }
    }
}
