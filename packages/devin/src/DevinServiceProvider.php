<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DevinServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DevinService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DevinService(
                apiKey: $creds->get('devin', 'api_key', ''),
                baseUrl: $creds->get('devin', 'url', 'https://api.devin.ai/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DevinToolProvider());
        }
    }
}
