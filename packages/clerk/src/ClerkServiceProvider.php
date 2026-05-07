<?php

namespace OpenCompany\Integrations\Clerk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Clerk integration with Laravel's service container.
 *
 * Binds ClerkService from host credentials and registers the Clerk tool provider
 * with the shared registry.
 */
class ClerkServiceProvider extends ServiceProvider
{
    /**
     * Register the Clerk service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(ClerkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ClerkService(
                secretKey: $creds->get('clerk', 'secret_key', ''),
                baseUrl: $creds->get('clerk', 'url', 'https://api.clerk.com/v1'),
            );
        });
    }

    /**
     * Boot the Clerk service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ClerkToolProvider());
        }
    }
}
