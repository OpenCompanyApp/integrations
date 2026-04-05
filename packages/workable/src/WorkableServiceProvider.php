<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Workable integration.
 *
 * Registers the WorkableService singleton and auto-discovers
 * the WorkableToolProvider with the ToolProviderRegistry.
 */
class WorkableServiceProvider extends ServiceProvider
{
    /**
     * Register Workable services into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WorkableService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WorkableService(
                accessToken: $creds->get('workable', 'access_token', ''),
                subdomain: $creds->get('workable', 'subdomain', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WorkableToolProvider());
        }
    }
}
