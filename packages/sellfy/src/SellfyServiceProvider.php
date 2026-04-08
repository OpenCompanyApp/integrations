<?php

namespace OpenCompany\Integrations\Sellfy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SellfyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SellfyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SellfyService(
                apiKey: $creds->get('sellfy', 'api_key', ''),
                baseUrl: $creds->get('sellfy', 'url', 'https://api.sellfy.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SellfyToolProvider());
        }
    }
}
