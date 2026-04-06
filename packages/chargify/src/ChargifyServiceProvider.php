<?php

namespace OpenCompany\Integrations\Chargify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ChargifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChargifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChargifyService(
                apiKey: $creds->get('chargify', 'api_key', ''),
                subdomain: $creds->get('chargify', 'subdomain', ''),
                baseUrl: $creds->get('chargify', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChargifyToolProvider());
        }
    }
}
