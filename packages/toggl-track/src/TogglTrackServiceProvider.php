<?php

namespace OpenCompany\Integrations\TogglTrack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * TogglTrackServiceProvider — Laravel service provider for the Toggl Track integration.
 *
 * Registers the TogglTrackService singleton with credentials resolved from the
 * integration configuration, and bootstraps the tool provider into the registry.
 */
class TogglTrackServiceProvider extends ServiceProvider
{
    /**
     * Register the TogglTrackService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TogglTrackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TogglTrackService(
                apiToken: $creds->get('toggl-track', 'api_token', ''),
                baseUrl: $creds->get('toggl-track', 'url', 'https://api.track.toggl.com'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TogglTrackToolProvider());
        }
    }
}
