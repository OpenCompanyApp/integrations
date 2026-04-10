<?php

namespace OpenCompany\Integrations\Plane;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Plane.so integration with Laravel's service container.
 *
 * Binds PlaneService as a singleton using credentials from CredentialResolver,
 * and registers the PlaneToolProvider with the ToolProviderRegistry on boot.
 */
class PlaneServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PlaneService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PlaneService(
                apiKey: $creds->get('plane', 'api_key', ''),
                baseUrl: $creds->get('plane', 'url', 'https://api.plane.so'),
                workspaceSlug: $creds->get('plane', 'workspace_slug', null),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PlaneToolProvider);
        }
    }
}
