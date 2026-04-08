<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshsalesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshsalesService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            $domain = $creds->get('freshsales', 'domain', '');
            $baseUrl = $domain
                ? 'https://' . $domain . '.myfreshworks.com/crm/sales'
                : '';

            return new FreshsalesService(
                apiKey: $creds->get('freshsales', 'api_key', ''),
                baseUrl: $baseUrl,
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshsalesToolProvider());
        }
    }
}
