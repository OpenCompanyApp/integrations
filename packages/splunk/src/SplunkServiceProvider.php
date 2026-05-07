<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Splunk integration with Laravel's service container.
 *
 * Binds the Splunk REST client and registers the tool provider when the shared
 * integration registry is available.
 */
class SplunkServiceProvider extends ServiceProvider
{
    /**
     * Register the Splunk service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SplunkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SplunkService(
                accessToken: $creds->get('splunk', 'access_token', ''),
                baseUrl: $creds->get('splunk', 'url', 'https://localhost:8089/services'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SplunkToolProvider());
        }
    }
}
