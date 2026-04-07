<?php

namespace OpenCompany\Integrations\Opsgenie;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Opsgenie integration.
 *
 * Registers the OpsgenieService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class OpsgenieServiceProvider extends ServiceProvider
{
    /**
     * Register the OpsgenieService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(OpsgenieService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OpsgenieService(
                apiKey: $creds->get('opsgenie', 'api_key', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the Opsgenie ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OpsgenieToolProvider());
        }
    }
}
