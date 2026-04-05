<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Teamwork integration.
 *
 * Registers the TeamworkService as a singleton using resolved credentials
 * and boots the tool provider into the registry.
 */
class TeamworkServiceProvider extends ServiceProvider
{
    /**
     * Register the TeamworkService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TeamworkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TeamworkService(
                apiKey:   $creds->get('teamwork', 'api_key', ''),
                hostname: $creds->get('teamwork', 'hostname', ''),
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
                ->register(new TeamworkToolProvider());
        }
    }
}
