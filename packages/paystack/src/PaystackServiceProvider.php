<?php

namespace OpenCompany\Integrations\Paystack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Paystack integration with Laravel's service container.
 *
 * Binds the Paystack service using stored credentials and registers the
 * tool provider with the shared integration registry when available.
 */
class PaystackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaystackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PaystackService(
                secretKey: $creds->get('paystack', 'secret_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PaystackToolProvider());
        }
    }
}
