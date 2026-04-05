<?php

namespace OpenCompany\Integrations\GitHub;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the GitHub integration with Laravel's service container.
 *
 * Binds the GitHubService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class GitHubServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GitHubService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new GitHubService(
                apiKey: $creds->get('github', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GitHubToolProvider());
        }
    }
}
