<?php

namespace OpenCompany\Integrations\GoogleBigQuery;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google BigQuery integration with Laravel's service container.
 *
 * Binds GoogleBigQueryService from host credentials and registers the generated
 * GoogleBigQueryToolProvider with the shared provider registry.
 */
class GoogleBigQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleBigQueryService::class, function ($app): GoogleBigQueryService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GoogleBigQueryService(
                accessToken: $creds?->get('google-bigquery', 'access_token', '') ?? '',
                baseUrl: $creds?->get('google-bigquery', 'url', 'https://bigquery.googleapis.com/bigquery/v2') ?? 'https://bigquery.googleapis.com/bigquery/v2',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GoogleBigQueryToolProvider);
        }
    }
}