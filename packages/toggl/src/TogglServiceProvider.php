<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Toggl Track integration.
 *
 * Registers the TogglService as a singleton and boots the TogglToolProvider
 * into the ToolProviderRegistry when available.
 */
class TogglServiceProvider extends ServiceProvider
{
    /**
     * Register the TogglService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TogglService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TogglService(
                apiToken: $creds->get('toggl', 'api_token', ''),
                baseUrl: $creds->get('toggl', 'url', 'https://api.track.toggl.com/api/v9'),
            );
        });
    }

    /**
     * Boot the Toggl tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TogglToolProvider());
        }
    }
}
