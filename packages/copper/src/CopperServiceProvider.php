<?php

namespace OpenCompany\Integrations\Copper;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CopperServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CopperService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CopperService(
                apiKey: $creds->get('copper', 'api_key', ''),
                email: $creds->get('copper', 'email', ''),
                baseUrl: $creds->get('copper', 'url', 'https://api.copper.com/developer_api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CopperToolProvider());
        }
    }
}
