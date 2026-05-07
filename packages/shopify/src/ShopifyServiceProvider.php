<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Shopify integration with Laravel's service container.
 *
 * Binds ShopifyService with host-provided credentials and registers the tool
 * provider when the integration registry is available.
 */
class ShopifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShopifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ShopifyService(
                accessToken: (string) $creds->get('shopify', 'access_token', ''),
                shopDomain: (string) $creds->get('shopify', 'shop_domain', ''),
                apiVersion: (string) $creds->get('shopify', 'api_version', '2025-10'),
                baseUrl: (string) $creds->get('shopify', 'base_url', ''),
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