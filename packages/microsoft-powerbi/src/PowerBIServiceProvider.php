<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PowerBIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PowerBIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PowerBIService(
                accessToken: $creds->get('microsoft_powerbi', 'access_token', ''),
                baseUrl: $creds->get('microsoft_powerbi', 'url', 'https://api.powerbi.com/v1.0/myorg'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PowerBIToolProvider());
        }
    }
}
