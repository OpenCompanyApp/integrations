<?php

namespace OpenCompany\Integrations\Adyen;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Adyen integration.
 *
 * Registers the AdyenService as a singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class AdyenServiceProvider extends ServiceProvider
{
    /**
     * Register the AdyenService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AdyenService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AdyenService(
                apiKey: $creds->get('adyen', 'api_key', ''),
                merchantAccount: $creds->get('adyen', 'merchant_account', ''),
                baseUrl: $creds->get('adyen', 'url', 'https://checkout-test.adyen.com'),
            );
        });
    }

    /**
     * Boot the Adyen tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AdyenToolProvider());
        }
    }
}
