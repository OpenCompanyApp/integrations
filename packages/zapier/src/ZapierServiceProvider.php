<?php

namespace OpenCompany\Integrations\Zapier;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zapier integration.
 *
 * Registers the ZapierService singleton and bootstraps the Zapier tool provider.
 */
class ZapierServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZapierService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZapierService(
                accessToken: $creds->get('zapier', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZapierToolProvider());
        }
    }
}
