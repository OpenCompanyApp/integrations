<?php

namespace OpenCompany\Integrations\Apollo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Apollo.io integration.
 *
 * Registers the ApolloService singleton with credentials from the
 * CredentialResolver and boots the tool provider into the registry.
 */
class ApolloServiceProvider extends ServiceProvider
{
    /**
     * Register the ApolloService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ApolloService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ApolloService(
                apiKey: $creds->get('apollo', 'api_key', ''),
                baseUrl: $creds->get('apollo', 'url', 'https://api.apollo.io'),
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
                ->register(new ApolloToolProvider());
        }
    }
}
