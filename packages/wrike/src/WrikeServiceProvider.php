<?php

namespace OpenCompany\Integrations\Wrike;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Wrike integration.
 *
 * Registers the WrikeService singleton and bootstraps the Wrike tool provider.
 */
class WrikeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WrikeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WrikeService(
                accessToken: $creds->get('wrike', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WrikeToolProvider());
        }
    }
}
