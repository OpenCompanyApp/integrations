<?php

namespace OpenCompany\Integrations\Stripe;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Stripe integration package.
 */
class StripeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StripeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StripeService(
                apiKey: $creds->get('stripe', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StripeToolProvider());
        }
    }
}
