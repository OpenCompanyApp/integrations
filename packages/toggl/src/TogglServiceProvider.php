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
            $apiToken = (string) $creds->get('toggl', 'api_token', '');
            $baseUrl = (string) $creds->get('toggl', 'url', '');

            if ($apiToken === '') {
                $apiToken = (string) $creds->get('toggl-track', 'api_token', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('toggl-track', 'url', 'https://api.track.toggl.com');
            }

            return new TogglService(
                apiToken: $apiToken,
                baseUrl: $baseUrl,
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
