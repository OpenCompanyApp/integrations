<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Grafana integration.
 *
 * Registers the GrafanaService singleton and bootstraps the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class GrafanaServiceProvider extends ServiceProvider
{
    /**
     * Register the GrafanaService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GrafanaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GrafanaService(
                apiToken: $creds->get('grafana', 'api_token', ''),
                hostname: $creds->get('grafana', 'hostname', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GrafanaToolProvider());
        }
    }
}
