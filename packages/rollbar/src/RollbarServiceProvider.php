<?php

namespace OpenCompany\Integrations\Rollbar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Rollbar integration.
 *
 * Registers the RollbarService singleton and the RollbarToolProvider
 * with the ToolProviderRegistry.
 */
class RollbarServiceProvider extends ServiceProvider
{
    /**
     * Register the RollbarService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RollbarService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RollbarService(
                accessToken: $creds->get('rollbar', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RollbarToolProvider());
        }
    }
}
