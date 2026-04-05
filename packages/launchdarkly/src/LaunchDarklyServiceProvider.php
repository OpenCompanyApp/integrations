<?php

namespace OpenCompany\Integrations\LaunchDarkly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LaunchDarklyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LaunchDarklyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LaunchDarklyService(
                accessToken: $creds->get('launchdarkly', 'access_token', ''),
                projectKey: $creds->get('launchdarkly', 'project_key', ''),
                baseUrl: $creds->get('launchdarkly', 'url', 'https://app.launchdarkly.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LaunchDarklyToolProvider());
        }
    }
}
