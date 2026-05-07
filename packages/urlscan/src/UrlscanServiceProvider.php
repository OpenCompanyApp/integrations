<?php

namespace OpenCompany\Integrations\Urlscan;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the urlscan.io integration with Laravel's service container.
 *
 * Binds UrlscanService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class UrlscanServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UrlscanService::class, function ($app): UrlscanService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new UrlscanService(
                apiKey: $creds?->get('urlscan', 'api_key', '') ?? '',
                baseUrl: $creds?->get('urlscan', 'url', 'https://urlscan.io') ?? 'https://urlscan.io',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new UrlscanToolProvider);
        }
    }
}
