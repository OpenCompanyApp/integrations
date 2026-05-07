<?php

namespace OpenCompany\Integrations\Bugsnag;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Bugsnag integration with Laravel's service container.
 *
 * Binds the Bugsnag API client from stored credentials and registers the tool
 * provider with the shared integration registry during application boot.
 */
class BugsnagServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BugsnagService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BugsnagService(
                apiToken: $creds->get('bugsnag', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BugsnagToolProvider());
        }
    }
}
