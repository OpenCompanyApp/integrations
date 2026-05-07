<?php

namespace OpenCompany\Integrations\DroneCi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Drone CI integration with Laravel.
 *
 * Binds the Drone API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class DroneCiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DroneCiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DroneCiService(
                accessToken: $creds->get('drone-ci', 'access_token', ''),
                baseUrl: $creds->get('drone-ci', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DroneCiToolProvider());
        }
    }
}
