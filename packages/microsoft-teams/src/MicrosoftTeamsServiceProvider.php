<?php

namespace OpenCompany\Integrations\MicrosoftTeams;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MicrosoftTeamsServiceProvider extends ServiceProvider
{
    /**
     * Register the MicrosoftTeamsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MicrosoftTeamsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MicrosoftTeamsService(
                accessToken: $creds->get('microsoft-teams', 'access_token', ''),
                baseUrl: $creds->get('microsoft-teams', 'base_url', 'https://graph.microsoft.com/v1.0'),
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
                ->register(new MicrosoftTeamsToolProvider());
        }
    }
}
