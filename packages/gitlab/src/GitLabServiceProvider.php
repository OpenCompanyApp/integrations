<?php

namespace OpenCompany\Integrations\GitLab;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the GitLab integration with Laravel's service container.
 *
 * Binds the GitLabService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class GitLabServiceProvider extends ServiceProvider
{
    /**
     * Register the GitLabService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GitLabService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GitLabService(
                apiToken: $creds->get('gitlab', 'api_token', ''),
                baseUrl: $creds->get('gitlab', 'base_url', 'https://gitlab.com/api/v4'),
            );
        });
    }

    /**
     * Boot the GitLab integration by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GitLabToolProvider());
        }
    }
}
