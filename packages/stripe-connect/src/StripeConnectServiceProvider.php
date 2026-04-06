<?php

namespace OpenCompany\Integrations\StripeConnect;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Stripe Connect integration package.
 */
class StripeConnectServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StripeConnectService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StripeConnectService(
                accessToken: $creds->get('stripe-connect', 'access_token', ''),
                baseUrl: $creds->get('stripe-connect', 'base_url', 'https://api.stripe.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StripeConnectToolProvider());
        }
    }
}
