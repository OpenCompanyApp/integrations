<?php

namespace OpenCompany\Integrations\Confluence;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Confluence integration with Laravel's service container.
 *
 * Binds the ConfluenceService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class ConfluenceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConfluenceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new ConfluenceService(
                apiToken: $creds->get('confluence', 'api_token', ''),
                baseUrl: $creds->get('confluence', 'base_url', 'https://your-domain.atlassian.com/wiki/rest/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ConfluenceToolProvider());
        }
    }
}
