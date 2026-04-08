<?php

namespace OpenCompany\Integrations\Harvest;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Harvest integration.
 *
 * Registers the HarvestService singleton and bootstraps the Harvest tool provider.
 */
class HarvestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HarvestService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HarvestService(
                accessToken: $creds->get('harvest', 'access_token', ''),
                accountId:   $creds->get('harvest', 'account_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HarvestToolProvider());
        }
    }
}
