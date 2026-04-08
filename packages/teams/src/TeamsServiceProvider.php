<?php

namespace OpenCompany\Integrations\Teams;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Microsoft Teams integration.
 *
 * Registers the TeamsService singleton and bootstraps the Teams tool provider.
 */
class TeamsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TeamsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TeamsService(
                accessToken: $creds->get('teams', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TeamsToolProvider());
        }
    }
}
