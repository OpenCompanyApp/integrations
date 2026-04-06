<?php

namespace OpenCompany\Integrations\PowerBi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PowerBiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PowerBiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PowerBiService(
                accessToken: $creds->get('powerbi', 'access_token', ''),
                baseUrl: $creds->get('powerbi', 'url', 'https://api.powerbi.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PowerBiToolProvider());
        }
    }
}
