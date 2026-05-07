<?php

namespace OpenCompany\Integrations\GoogleCloudSearch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Cloud Search integration with Laravel's service container.
 *
 * Binds GoogleCloudSearchService from host credentials and registers the generated
 * GoogleCloudSearchToolProvider with the shared provider registry.
 */
class GoogleCloudSearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleCloudSearchService::class, function ($app): GoogleCloudSearchService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleCloudSearchService(accessToken: $creds?->get('google-cloud-search', 'access_token', '') ?? '', baseUrl: $creds?->get('google-cloud-search', 'url', 'https://cloudsearch.googleapis.com') ?? 'https://cloudsearch.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleCloudSearchToolProvider);
    }
}