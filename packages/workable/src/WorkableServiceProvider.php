<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Workable integration.
 *
 * Registers the WorkableService as a singleton and bootstraps
 * the WorkableToolProvider into the ToolProviderRegistry.
 */
class WorkableServiceProvider extends ServiceProvider
{
    /**
     * Register the WorkableService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(WorkableService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WorkableService(
                accessToken: $creds->get('workable', 'access_token', ''),
                subdomain: $creds->get('workable', 'subdomain', ''),
                baseUrl: $creds->get('workable', 'base_url', 'https://www.workable.com/spi/v3/accounts'),
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
                ->register(new WorkableToolProvider());
        }
    }
}
