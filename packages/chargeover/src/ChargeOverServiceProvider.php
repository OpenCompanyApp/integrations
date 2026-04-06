<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ChargeOverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChargeOverService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChargeOverService(
                accessToken: $creds->get('chargeover', 'access_token', ''),
                subdomain: $creds->get('chargeover', 'subdomain', ''),
                baseUrl: $creds->get('chargeover', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChargeOverToolProvider());
        }
    }
}
