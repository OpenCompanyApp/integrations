<?php

namespace OpenCompany\Integrations\GitBook;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the GitBook integration with Laravel's service container.
 *
 * Binds GitBookService using host credentials and registers the provider with
 * the ToolProviderRegistry during boot.
 */
class GitBookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GitBookService::class, function ($app): GitBookService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GitBookService(token: $creds?->get('gitbook', 'api_token', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GitBookToolProvider);
        }
    }
}
