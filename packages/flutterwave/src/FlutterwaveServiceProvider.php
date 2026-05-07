<?php

namespace OpenCompany\Integrations\Flutterwave;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Flutterwave integration with Laravel's service container.
 *
 * Binds the Flutterwave service using stored credentials and registers the
 * tool provider with the shared registry when available.
 */
class FlutterwaveServiceProvider extends ServiceProvider
{
    /**
     * Register the Flutterwave service as a singleton.
     *
     * Resolves credentials from the CredentialResolver and binds
     * FlutterwaveService into the container for the lifetime of the request.
     */
    public function register(): void
    {
        $this->app->singleton(FlutterwaveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FlutterwaveService(
                secretKey: $creds->get('flutterwave', 'secret_key', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the FlutterwaveToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FlutterwaveToolProvider());
        }
    }
}
