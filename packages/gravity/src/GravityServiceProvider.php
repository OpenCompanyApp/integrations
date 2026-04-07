<?php

namespace OpenCompany\Integrations\Gravity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GravityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GravityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GravityService(
                apiKey: $creds->get('gravity', 'api_key', ''),
                baseUrl: $creds->get('gravity', 'url', 'https://api.gravity.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GravityToolProvider());
        }
    }
}
