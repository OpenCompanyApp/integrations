<?php

namespace OpenCompany\Integrations\TravisCi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Travis CI integration with Laravel.
 *
 * Binds the API client from host credentials and registers the tool provider
 * when the shared registry is available.
 */
class TravisCiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TravisCiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TravisCiService(
                apiToken: $creds->get('travis-ci', 'api_token', ''),
                baseUrl: $creds->get('travis-ci', 'url', 'https://api.travis-ci.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new TravisCiToolProvider());
        }
    }
}
