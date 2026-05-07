<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Mattermost integration with Laravel's service container.
 *
 * Binds MattermostService from host credentials and registers MattermostToolProvider
 * with the shared provider registry.
 */
class MattermostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MattermostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MattermostService(
                accessToken: $creds->get('mattermost', 'access_token', ''),
                baseUrl: $creds->get('mattermost', 'url', 'https://mattermost.example.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MattermostToolProvider());
        }
    }
}
