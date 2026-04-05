<?php

namespace OpenCompany\Integrations\NetSuite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NetSuiteServiceProvider extends ServiceProvider
{
    /**
     * Register the NetSuite service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(NetSuiteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NetSuiteService(
                accessToken: $creds->get('netsuite', 'access_token', ''),
                baseUrl: $creds->get('netsuite', 'url', ''),
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
                ->register(new NetSuiteToolProvider());
        }
    }
}
