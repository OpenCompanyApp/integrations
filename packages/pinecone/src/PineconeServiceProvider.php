<?php

namespace OpenCompany\Integrations\Pinecone;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Pinecone integration.
 *
 * Registers the PineconeService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class PineconeServiceProvider extends ServiceProvider
{
    /**
     * Register the PineconeService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(PineconeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PineconeService(
                accessToken: $creds->get('pinecone', 'api_key', $creds->get('pinecone', 'access_token', '')),
                baseUrl: $creds->get('pinecone', 'url', 'https://api.pinecone.io'),
                apiVersion: $creds->get('pinecone', 'api_version', '2026-04'),
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
                ->register(new PineconeToolProvider());
        }
    }
}
