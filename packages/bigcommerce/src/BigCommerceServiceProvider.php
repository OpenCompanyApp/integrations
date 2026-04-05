<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BigCommerceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BigCommerceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BigCommerceService(
                accessToken: $creds->get('bigcommerce', 'access_token', ''),
                storeId: $creds->get('bigcommerce', 'store_id', ''),
                clientId: $creds->get('bigcommerce', 'client_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BigCommerceToolProvider());
        }
    }
}
