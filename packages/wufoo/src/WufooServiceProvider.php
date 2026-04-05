<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WufooServiceProvider extends ServiceProvider
{
    /**
     * Register the Wufoo service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WufooService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WufooService(
                apiKey: $creds->get('wufoo', 'api_key', ''),
                subdomain: $creds->get('wufoo', 'subdomain', ''),
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
                ->register(new WufooToolProvider());
        }
    }
}
