<?php

namespace OpenCompany\Integrations\Xata;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Xata integration with Laravel.
 *
 * Binds XataService from configured credentials and registers the provider
 * with the shared ToolProviderRegistry when available.
 */
class XataServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XataService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XataService(
                apiKey: $creds->get('xata', 'api_key', ''),
                workspaceId: $creds->get('xata', 'workspace_id', ''),
                apiEndpoint: $creds->get('xata', 'api_endpoint', ''),
                baseUrl: $creds->get('xata', 'url', 'https://api.xata.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XataToolProvider());
        }
    }
}
