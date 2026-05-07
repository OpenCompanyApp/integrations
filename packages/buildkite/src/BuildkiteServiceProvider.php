<?php

namespace OpenCompany\Integrations\Buildkite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Buildkite integration with Laravel.
 *
 * Binds the Buildkite API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class BuildkiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BuildkiteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BuildkiteService(
                accessToken: $creds->get('buildkite', 'access_token', ''),
                baseUrl: $creds->get('buildkite', 'url', 'https://api.buildkite.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BuildkiteToolProvider());
        }
    }
}
