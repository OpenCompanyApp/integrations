<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Toggl integration.
 *
 * Registers the TogglService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry.
 */
class TogglServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TogglService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TogglService(
                apiToken: $creds->get('toggl', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TogglToolProvider());
        }
    }
}
