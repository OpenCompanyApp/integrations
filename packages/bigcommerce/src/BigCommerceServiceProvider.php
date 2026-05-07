<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the BigCommerce integration with Laravel's service container.
 *
 * Binds BigCommerceService with host-provided credentials and registers the
 * tool provider when the integration registry is available.
 */
class BigCommerceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BigCommerceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BigCommerceService(
                accessToken: (string) $creds->get('bigcommerce', 'access_token', ''),
                storeHash: (string) $creds->get('bigcommerce', 'store_hash', ''),
                baseUrl: (string) $creds->get('bigcommerce', 'base_url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BigCommerceToolProvider());
        }
    }
}