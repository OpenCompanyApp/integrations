<?php

namespace OpenCompany\Integrations\Jenkins;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Jenkins integration with Laravel's service container.
 *
 * Binds the JenkinsService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class JenkinsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JenkinsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new JenkinsService(
                apiToken: $creds->get('jenkins', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new JenkinsToolProvider());
        }
    }
}
