<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the XeroService singleton and bootstraps Xero tools.
 */
class XeroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XeroService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XeroService(
                accessToken: $creds->get('xero', 'access_token', ''),
                baseUrl: $creds->get('xero', 'base_url', 'https://api.xero.com/api.xro/2.0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XeroToolProvider());
        }
    }
}
