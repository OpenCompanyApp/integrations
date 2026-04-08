<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BraintreeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BraintreeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BraintreeService(
                accessToken: $creds->get('braintree', 'access_token', ''),
                merchantId: $creds->get('braintree', 'merchant_id', ''),
                baseUrl: $creds->get('braintree', 'url', 'https://api.braintreegateway.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BraintreeToolProvider());
        }
    }
}
