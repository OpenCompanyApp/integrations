<?php

namespace OpenCompany\Integrations\NewsApi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the NewsAPI integration with Laravel's service container.
 *
 * Binds NewsApiService using host credentials and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class NewsApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NewsApiService::class, function ($app): NewsApiService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new NewsApiService(apiKey: $creds?->get('newsapi', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new NewsApiToolProvider);
        }
    }
}
