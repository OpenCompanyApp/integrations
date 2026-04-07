<?php

namespace OpenCompany\Integrations\Taxjar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the TaxJar integration.
 *
 * Registers the TaxjarService as a singleton and boots the
 * TaxjarToolProvider into the ToolProviderRegistry.
 */
class TaxjarServiceProvider extends ServiceProvider
{
    /**
     * Register the TaxjarService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TaxjarService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TaxjarService(
                accessToken: $creds->get('taxjar', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the TaxjarToolProvider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TaxjarToolProvider());
        }
    }
}
