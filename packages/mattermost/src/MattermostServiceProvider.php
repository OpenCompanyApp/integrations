<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mattermost integration.
 *
 * Registers the MattermostService singleton and bootstraps the Mattermost tool provider.
 */
class MattermostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MattermostService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MattermostService(
                apiToken: $creds->get('mattermost', 'api_token', ''),
                baseUrl: $creds->get('mattermost', 'base_url', ''),
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
