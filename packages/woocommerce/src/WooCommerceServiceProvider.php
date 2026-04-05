<?php

namespace OpenCompany\Integrations\WooCommerce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the WooCommerce integration.
 *
 * Registers the {@see WooCommerceService} singleton and auto-discovers
 * the {@see WooCommerceToolProvider} with the ToolProviderRegistry.
 */
class WooCommerceServiceProvider extends ServiceProvider
{
    /**
     * Register the WooCommerce service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WooCommerceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WooCommerceService(
                consumerKey: $creds->get('woocommerce', 'consumer_key', ''),
                consumerSecret: $creds->get('woocommerce', 'consumer_secret', ''),
                baseUrl: $creds->get('woocommerce', 'url', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider if the registry is bound.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WooCommerceToolProvider());
        }
    }
}
