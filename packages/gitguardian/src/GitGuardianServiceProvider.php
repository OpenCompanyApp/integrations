<?php

namespace OpenCompany\Integrations\GitGuardian;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the GitGuardian integration with Laravel's service container.
 *
 * Binds GitGuardianService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class GitGuardianServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GitGuardianService::class, function ($app): GitGuardianService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GitGuardianService(
                apiKey: $creds?->get('gitguardian', 'api_key', '') ?? '',
                baseUrl: $creds?->get('gitguardian', 'url', 'https://api.gitguardian.com') ?? 'https://api.gitguardian.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GitGuardianToolProvider);
        }
    }
}
