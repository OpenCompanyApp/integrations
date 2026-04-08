<?php

namespace OpenCompany\Integrations\PayPal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the PayPal integration.
 *
 * Registers the PayPalService singleton and auto-discovers
 * the PayPalToolProvider with the ToolProviderRegistry.
 */
class PayPalServiceProvider extends ServiceProvider
{
    /**
     * Register the PayPal service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(PayPalService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PayPalService(
                accessToken: $creds->get('paypal', 'access_token', ''),
                baseUrl: $creds->get('paypal', 'url', 'https://api-m.paypal.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PayPalToolProvider());
        }
    }
}
