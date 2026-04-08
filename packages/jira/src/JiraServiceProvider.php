<?php

namespace OpenCompany\Integrations\Jira;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Jira integration with Laravel's service container.
 *
 * Binds the JiraService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class JiraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JiraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new JiraService(
                apiToken: $creds->get('jira', 'api_token', ''),
                baseUrl: $creds->get('jira', 'base_url', 'https://your-domain.atlassian.net'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new JiraToolProvider());
        }
    }
}
