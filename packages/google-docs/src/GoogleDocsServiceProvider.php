<?php

namespace OpenCompany\Integrations\GoogleDocs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Google Docs integration.
 *
 * Registers the GoogleDocsService singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class GoogleDocsServiceProvider extends ServiceProvider
{
    /**
     * Register the GoogleDocsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleDocsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleDocsService(
                accessToken: $creds->get('google-docs', 'access_token', ''),
                baseUrl: $creds->get('google-docs', 'url', 'https://docs.googleapis.com'),
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
                ->register(new GoogleDocsToolProvider());
        }
    }
}
