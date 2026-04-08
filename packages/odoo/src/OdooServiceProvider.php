<?php

namespace OpenCompany\Integrations\Odoo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Odoo ERP integration.
 *
 * Registers the OdooService as a singleton using resolved credentials
 * and boots the tool provider into the ToolProviderRegistry.
 */
class OdooServiceProvider extends ServiceProvider
{
    /**
     * Register the OdooService singleton with resolved credentials.
     */
    public function register(): void
    {
        $this->app->singleton(OdooService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OdooService(
                apiKey: $creds->get('odoo', 'api_key', ''),
                baseUrl: $creds->get('odoo', 'url', 'https://your-odoo-instance.com'),
                database: $creds->get('odoo', 'database', ''),
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
                ->register(new OdooToolProvider());
        }
    }
}
