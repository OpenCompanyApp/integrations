<?php

namespace OpenCompany\Integrations\PowerBi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Power BI integration with Laravel.
 *
 * Binds the API service from stored credentials and registers the tool provider
 * with the shared registry during boot.
 */
class PowerBiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PowerBiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $accessToken = $creds->get('powerbi', 'access_token', '')
                ?: $creds->get('microsoft_powerbi', 'access_token', '');
            $baseUrl = $creds->get('powerbi', 'url', '')
                ?: $creds->get('microsoft_powerbi', 'url', 'https://api.powerbi.com');

            return new PowerBiService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
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
