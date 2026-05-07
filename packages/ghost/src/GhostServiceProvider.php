<?php

namespace OpenCompany\Integrations\Ghost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Ghost integration with Laravel's service container.
 */
class GhostServiceProvider extends ServiceProvider
{
    /**
     * Register the Ghost Admin API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GhostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GhostService(
                apiKey: $creds->get('ghost', 'api_key', ''),
                baseUrl: $creds->get('ghost', 'url', ''),
            );
        });
    }

    /**
     * Register the Ghost tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GhostToolProvider());
        }
    }
}
