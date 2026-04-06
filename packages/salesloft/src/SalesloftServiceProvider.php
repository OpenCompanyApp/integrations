<?php

namespace OpenCompany\Integrations\Salesloft;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SalesloftServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SalesloftService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SalesloftService(
                accessToken: $creds->get('salesloft', 'access_token', ''),
                baseUrl: $creds->get('salesloft', 'url', 'https://api.salesloft.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SalesloftToolProvider());
        }
    }
}
