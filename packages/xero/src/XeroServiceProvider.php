<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Xero integration package.
 *
 * Registers the XeroService singleton and boots the XeroToolProvider
 * into the ToolProviderRegistry.
 */
class XeroServiceProvider extends ServiceProvider
{
    /**
     * Register the XeroService singleton with resolved credentials.
     */
    public function register(): void
    {
        $this->app->singleton(XeroService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XeroService(
                accessToken: $creds->get('xero', 'access_token', ''),
                tenantId: $creds->get('xero', 'tenant_id', ''),
            );
        });
    }

    /**
     * Boot the Xero tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XeroToolProvider());
        }
    }
}
