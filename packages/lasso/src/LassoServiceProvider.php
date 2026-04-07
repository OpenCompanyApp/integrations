<?php

namespace OpenCompany\Integrations\Lasso;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Lasso CRM integration.
 *
 * Registers the LassoService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class LassoServiceProvider extends ServiceProvider
{
    /**
     * Register the LassoService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(LassoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LassoService(
                token: $creds->get('lasso', 'token', ''),
                baseUrl: $creds->get('lasso', 'url', 'https://api.lassocrm.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LassoToolProvider());
        }
    }
}
