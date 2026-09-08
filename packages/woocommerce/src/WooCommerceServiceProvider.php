<?php

namespace OpenCompany\Integrations\Woocommerce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WooCommerceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WooCommerceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WooCommerceService(
                accessToken: $creds->get('woocommerce', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WooCommerceToolProvider());
        }
    }
}
