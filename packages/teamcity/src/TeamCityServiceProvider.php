<?php

namespace OpenCompany\Integrations\TeamCity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the TeamCity integration with Laravel.
 *
 * Binds the TeamCity API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class TeamCityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TeamCityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TeamCityService(
                accessToken: $creds->get('teamcity', 'access_token', ''),
                baseUrl: $creds->get('teamcity', 'url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new TeamCityToolProvider());
        }
    }
}
