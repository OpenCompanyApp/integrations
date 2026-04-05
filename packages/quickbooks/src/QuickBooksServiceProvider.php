<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the QuickBooks integration package.
 *
 * Registers the QuickBooksService singleton and bootstraps the tool provider.
 */
class QuickBooksServiceProvider extends ServiceProvider
{
    /**
     * Register the QuickBooksService singleton with resolved credentials.
     */
    public function register(): void
    {
        $this->app->singleton(QuickBooksService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new QuickBooksService(
                accessToken: $creds->get('quickbooks', 'access_token', ''),
                realmId: $creds->get('quickbooks', 'realm_id', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the QuickBooks tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new QuickBooksToolProvider());
        }
    }
}
