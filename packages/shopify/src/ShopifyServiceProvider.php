<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Shopify integration package.
 *
 * Registers the ShopifyService singleton with credentials from the CredentialResolver
 * and bootstraps the ShopifyToolProvider into the ToolProviderRegistry.
 */
class ShopifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShopifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ShopifyService(
                accessToken: $creds->get('shopify', 'access_token', ''),
                shopName: $creds->get('shopify', 'shop_name', ''),
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
