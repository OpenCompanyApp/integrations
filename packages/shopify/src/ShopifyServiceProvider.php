<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ShopifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShopifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ShopifyService(
                accessToken: $creds->get('shopify', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ShopifyToolProvider());
        }
    }
}
