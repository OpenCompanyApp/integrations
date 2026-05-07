<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Braintree integration with Laravel's service container.
 */
class BraintreeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BraintreeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new BraintreeService($creds->get('braintree', 'access_token', ''), $creds->get('braintree', 'merchant_id', ''), $creds->get('braintree', 'url', 'https://payments.sandbox.braintree-api.com/graphql'), $creds->get('braintree', 'public_key', ''), $creds->get('braintree', 'private_key', ''), $creds->get('braintree', 'version', '2019-01-01'));
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BraintreeToolProvider);
        }
    }
}