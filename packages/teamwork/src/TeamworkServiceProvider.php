<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Teamwork integration.
 *
 * Registers the TeamworkService singleton and bootstraps the Teamwork tool provider.
 */
class TeamworkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TeamworkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TeamworkService(
                apiToken: $creds->get('teamwork', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TeamworkToolProvider());
        }
    }
}
