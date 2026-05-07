<?php

namespace OpenCompany\Integrations\GoogleDocs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Docs integration with Laravel's service container.
 *
 * Binds GoogleDocsService from host credentials and registers the generated
 * GoogleDocsToolProvider with the shared provider registry.
 */
class GoogleDocsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDocsService::class, function ($app): GoogleDocsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleDocsService(accessToken: $creds?->get('google-docs', 'access_token', '') ?? '', baseUrl: $creds?->get('google-docs', 'url', 'https://docs.googleapis.com') ?? 'https://docs.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleDocsToolProvider);
    }
}
