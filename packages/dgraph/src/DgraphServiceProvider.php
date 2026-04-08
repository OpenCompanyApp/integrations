<?php

namespace OpenCompany\Integrations\Dgraph;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the DgraphService singleton and bootstraps Dgraph tools.
 */
class DgraphServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DgraphService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DgraphService(
                bearerToken: $creds->get('dgraph', 'bearer_token', ''),
                baseUrl: $creds->get('dgraph', 'base_url', 'https://api.dgraph.io/graphql'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DgraphToolProvider());
        }
    }
}
