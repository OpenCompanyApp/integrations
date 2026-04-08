<?php

namespace OpenCompany\Integrations\Razorpay;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Razorpay integration.
 *
 * Registers the RazorpayService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class RazorpayServiceProvider extends ServiceProvider
{
    /**
     * Register the RazorpayService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RazorpayService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RazorpayService(
                keyId: $creds->get('razorpay', 'key_id', ''),
                keySecret: $creds->get('razorpay', 'key_secret', ''),
                baseUrl: $creds->get('razorpay', 'url', 'https://api.razorpay.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RazorpayToolProvider());
        }
    }
}
