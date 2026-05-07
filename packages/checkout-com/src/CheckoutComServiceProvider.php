<?php

namespace OpenCompany\Integrations\CheckoutCom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Checkout.com integration with Laravel's service container.
 *
 * Binds CheckoutComService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class CheckoutComServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CheckoutComService::class, function ($app): CheckoutComService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new CheckoutComService(
                apiKey: $creds?->get('checkout-com', 'api_key', '') ?? '',
                baseUrl: $creds?->get('checkout-com', 'url', 'https://api.sandbox.checkout.com') ?? 'https://api.sandbox.checkout.com',
                accessBaseUrl: $creds?->get('checkout-com', 'access_url', 'https://access.sandbox.checkout.com') ?? 'https://access.sandbox.checkout.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CheckoutComToolProvider);
        }
    }
}
