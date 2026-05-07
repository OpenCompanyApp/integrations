<?php

namespace OpenCompany\Integrations\MicrosoftTeams;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Teams integration with Laravel.
 *
 * Binds the Graph API service using stored credentials and publishes the tool
 * provider into the shared integration registry during boot.
 */
class MicrosoftTeamsServiceProvider extends ServiceProvider
{
    /**
     * Register the MicrosoftTeamsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MicrosoftTeamsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $accessToken = (string) $creds->get('microsoft-teams', 'access_token', '');
            $baseUrl = (string) $creds->get('microsoft-teams', 'base_url', '');

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('teams', 'access_token', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('teams', 'base_url', 'https://graph.microsoft.com/v1.0');
            }

            return new MicrosoftTeamsService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
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
